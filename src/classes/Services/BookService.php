<?php

namespace CT275\Labs\Services;

use PDO;

class BookService
{
    private PDO $pdo;
    private $authorizedUserId;

    public function __construct(PDO $pdo, int $authorizedUserId)
    {
        $this->pdo = $pdo;
        $this->authorizedUserId = $authorizedUserId;
    }

    /**
     * Retrieve all books.
     * 
     * @return array An array of books
     */
    public function getAllBooks(): array
    {
        $query = "SELECT * FROM books WHERE user_id = :user_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':user_id' => $this->authorizedUserId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a new book.
     * 
     * @param array $bookData The data of the book to be added
     * @return bool True on success, false on failure
     */
    public function addBook(array $bookData): bool
    {
        $query = "INSERT INTO books (user_id, title, author, genre, published_year, image_url) 
                  VALUES (:user_id, :title, :author, :genre, :published_year, :image_url)";

        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            ':user_id' => $this->authorizedUserId,
            ':title' => $bookData['title'],
            ':author' => $bookData['author'],
            ':genre' => $bookData['genre'],
            ':published_year' => $bookData['published_year'],
            ':image_url' => $bookData['image_url'],
        ]);
    }

    /**
     * Update an existing book.
     * 
     * @param int $bookId The ID of the book to be updated
     * @param array $bookData The updated data of the book
     * @return bool True on success, false on failure
     */
    public function editBook(int $bookId, array $bookData): bool
    {
        $query = "UPDATE books 
                  SET title = :title, author = :author, genre = :genre, published_year = :published_year, image_url = :image_url
                  WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            ':title' => $bookData['title'],
            ':author' => $bookData['author'],
            ':genre' => $bookData['genre'],
            ':published_year' => $bookData['published_year'],
            ':image_url' => $bookData['image_url'],
            ':id' => $bookId,
            ':user_id' => $this->authorizedUserId,
        ]);
    }

    /**
     * Delete a book.
     * 
     * @param int $bookId The ID of the book to be deleted
     * @return bool True on success, false on failure
     */
    public function deleteBook(int $bookId): bool
    {
        $query = "DELETE FROM books WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['id' => $bookId, 'user_id' => $this->authorizedUserId]);
    }

    /**
     * Validate book data.
     *
     * @param array $bookData The book data to validate.
     * @return array An array of validation errors, if any.
     */
    public function validateBookData(array $bookData): array
    {
        $errors = [];

        if (empty($bookData['title'])) {
            $errors[] = "Title is required";
        }
        if (empty($bookData['author'])) {
            $errors[] = "Author is required";
        }
        if (empty($bookData['genre'])) {
            $errors[] = "Genre is required";
        }
        if (empty($bookData['published_year'])) {
            $errors[] = "Published year is required";
        }
        if (empty($bookData['image_url'])) {
            $errors[] = "Image URL is required";
        }

        return $errors;
    }

    /**
     * Retrieve a book by its ID.
     *
     * @param int $bookId The ID of the book to retrieve.
     * @return array|null The book data if found, or null if not found.
     */
    public function getBookById(int $bookId): ?array
    {
        $query = "SELECT * FROM books WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $bookId, 'user_id' => $this->authorizedUserId]);

        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        return $book ? $book : null;
    }
}
