<?php

namespace CT275\Labs\Services;

use PDO;

class QuoteService
{
    private PDO $pdo;
    private $authorizedUserId;

    public function __construct(PDO $pdo, int $authorizedUserId)
    {
        $this->pdo = $pdo;
        $this->authorizedUserId = $authorizedUserId;
    }

    public function searchQuotesWithCriteria(array $criteria): array
    {
        $params = [];

        $query = 'SELECT * FROM quotes q WHERE user_id = :user_id';
        $params[':user_id'] = [$this->authorizedUserId, PDO::PARAM_INT];

        if (!empty($criteria['searchTerm'])) {
            $query .= ' AND (LOWER(quote_text) LIKE :search_term OR LOWER(author) LIKE :search_term)';
            $params[':search_term'] = ['%' . strtolower($criteria['searchTerm']) . '%', PDO::PARAM_STR];
        }

        $sortField = $criteria['sortField'] ?? 'created_at';
        $sortOrder = ($criteria['sortAsc'] ?? false) ? ' ASC' : ' DESC';
        if ($this->isValidSortField($sortField)) {
            $query .= ' ORDER BY ' . $sortField . $sortOrder;
        }

        $query .= ' LIMIT :limit OFFSET :offset';
        $params[':limit'] = [$criteria['perPage'], PDO::PARAM_INT];
        $params[':offset'] = [($criteria['page'] - 1) * $criteria['perPage'], PDO::PARAM_INT];

        $stmt = $this->pdo->prepare($query);

        foreach ($params as $paramName => [$paramValue, $paramType]) {
            $stmt->bindValue($paramName, $paramValue, $paramType);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function isValidSortField(string $sortField): bool
    {
        $validSortFields = ['author', 'created_at'];
        return in_array($sortField, $validSortFields);
    }

    /**
     * Add a new quote.
     *
     * @param array $quoteData The data of the quote to be added
     * @return bool True on success, false on failure.
     */
    public function addQuote(array $quoteData): bool
    {
        $query = "INSERT INTO quotes (user_id, quote_text, author) 
                  VALUES (:user_id, :quote_text, :author)";

        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            'user_id' => $this->authorizedUserId,
            'quote_text' => $quoteData['quote_text'],
            'author' => $quoteData['author']
        ]);
    }

    /**
     * Update an existing quote.
     *
     * @param int $quoteId The ID of the quote to be updated.
     * @param array $quoteData The updated data of the quote.
     * @return bool True on success, false on failure.
     */
    public function editQuote(int $quoteId, array $quoteData): bool
    {
        $query = "UPDATE quotes SET quote_text = :quote_text, author = :author  
                  WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            'quote_text' => $quoteData['quote_text'],
            'author' => $quoteData['author'],
            'id' => $quoteId,
            'user_id' => $this->authorizedUserId
        ]);
    }

    /**
     * Delete a quote.
     *
     * @param int $quoteId The ID of the quote to be deleted.
     * @return bool True on success, false on failure.
     */
    public function deleteQuote(int $quoteId): bool
    {
        $query = "DELETE FROM quotes WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['id' => $quoteId, 'user_id' => $this->authorizedUserId]);
    }

    /**
     * Validate quote data.
     *
     * @param array $quoteData The quote data to validate.
     * @return array An array of validation errors, if any.
     */
    public function validateQuoteData(array $quoteData): array
    {
        $errors = [];

        if (empty($quoteData['quote_text'])) {
            $errors[] = "Quote text is required";
        }
        if (empty($quoteData['author'])) {
            $errors[] = "Author is required";
        }

        return $errors;
    }

    /**
     * Retrieve a quote by its ID.
     *
     * @param int $quoteId The ID of the quote to retrieve.
     * @return array|null The quote data if found, or null if not found.
     */
    public function getQuoteById(int $quoteId): ?array
    {
        $query = "SELECT * FROM quotes WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $quoteId, 'user_id' => $this->authorizedUserId]);

        $quote = $stmt->fetch(PDO::FETCH_ASSOC);
        return $quote ? $quote : null;
    }

    /**
     * Toggle the favorite status of a quote.
     *
     * @param int $quoteId The ID of the quote to toggle.
     * @return bool True on success, false on failure.
     */
    public function toggleFavoriteQuote(int $quoteId): bool
    {
        $query = "UPDATE quotes SET favorite = NOT favorite 
                  WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['id' => $quoteId, 'user_id' => $this->authorizedUserId]);
    }
}
