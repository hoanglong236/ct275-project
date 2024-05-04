<?php

namespace CT275\Labs\Services;

use PDO;

class UserService
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Authenticate user.
     * 
     * @param string $username The username.
     * @param string $password The password.
     * @return array|null Returns the user data if authentication is successful, otherwise null.
     */
    public function authenticate(string $username, string $password): ?array
    {
        $query = "SELECT * FROM users WHERE username = :username";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['username' => $username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password if user exists
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    /**
     * Set the authorized user information in the session.
     * 
     * @param array $user The user data.
     * @return void
     */
    public function setAuthorizedUser(array $user): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    }

    /**
     * Get the authorized user information from the session.
     *
     * @return array The authorized user data.
     */
    public function getAuthorizedUser(): array
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return [
            'id' => $_SESSION['user_id'] ?? null,
            'username' => $_SESSION['username'] ?? null
        ];
    }

    /**
     * Sign up a new user.
     * 
     * @param string $username The username.
     * @param string $password The password.
     * @return void
     */
    public function signUp(string $username, string $password): void
    {
        $query = "INSERT INTO users(username, password) VALUES (:username, :password)";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]);
    }

    /**
     * Sign out the user (destroy session).
     * 
     * @return void
     */
    public function signOut(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
    }

    /**
     * Check if a username exists.
     * 
     * @param string $username The username to check.
     * @return bool Returns true if the username exists, otherwise false.
     */
    public function usernameExists(string $username): bool
    {
        $query = "SELECT COUNT(*) FROM users WHERE username = :username";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['username' => $username]);

        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}
