<?php

namespace CT275\Labs\Common;

class Authorization
{
    private const SESSION_KEY = 'authorized_user';

    public static function setAuthorizedUser(array $userData): void
    {
        self::ensureSessionStarted();
        $_SESSION[self::SESSION_KEY] = $userData;
    }

    public static function getAuthorizedUser(): ?array
    {
        self::ensureSessionStarted();
        return $_SESSION[self::SESSION_KEY] ?? null;
    }

    public static function redirectIfUnauthorized(string $url = '/sign-in.php'): void
    {
        if (empty(self::getAuthorizedUser())) {
            redirect($url);
        }
    }

    private static function ensureSessionStarted(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}