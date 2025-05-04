<?php

namespace CT275\Labs\Common;

class Authorization
{
    private const SESSION_KEY = 'authorized_user';

    public static function setAuthorizedUser(array $userData): void
    {
        $_SESSION[self::SESSION_KEY] = $userData;
    }

    public static function getAuthorizedUser(): ?array
    {
        return $_SESSION[self::SESSION_KEY] ?? null;
    }

    public static function redirectIfUnauthorized(string $url = '/sign-in.php'): void
    {
        if (empty(self::getAuthorizedUser())) {
            redirect($url);
        }
    }

    public static function revokeUserAuthorization(): void
    {
        unset($_SESSION[self::SESSION_KEY]);

        session_unset();
        session_destroy();
    }
}