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

    /**
     * Retrieve all quotes.
     *
     * @return array An array of quotes.
     */
    public function getAllQuotes(): array
    {
        $query = "SELECT * FROM quotes q WHERE user_id = :user_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $this->authorizedUserId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Search for quotes containing a given search term in the quote text or author field.
     *
     * @param string $searchTerm The term to search.
     * @return array An array of quotes matching the search term.
     */
    public function searchQuotes(string $searchTerm): array
    {
        $query = "SELECT * FROM quotes q 
                  WHERE user_id = :user_id 
                      AND (LOWER(quote_text) LIKE :search_term OR LOWER(author) LIKE :search_term)";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            ':user_id' => $this->authorizedUserId,
            ':search_term' => '%' . strtolower($searchTerm) . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
