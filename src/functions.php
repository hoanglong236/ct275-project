<?php

function redirect(string $location): void
{
    header('Location: ' . $location, true, 302);
    exit();
}

function html_escape(string|null $text): string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8', false);
}

function createPDOInstance()
{
    try {
        return (new CT275\Labs\Database\PDOFactory())->create();
    } catch (Exception $ex) {
        echo 'Unable to connect to MySQL, please check your credentials to connect to MySQL.<br>';
        exit("<pre>{$ex}</pre>");
    }
}