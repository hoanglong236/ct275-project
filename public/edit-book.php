<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;
use CT275\Labs\Services\BookService;

$userService = new UserService($pdo);
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

$bookId = $_GET['id'] ?? null;
if (empty($bookId)) {
    redirect('/index.php');
}

$bookService = new BookService($pdo, $authorizedUser['id']);

$book = $bookService->getBookById($bookId);
if (empty($book)) {
    redirect('/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookData = array_map('trim', $_POST);

    $errors = $bookService->validateBookData($bookData);
    if (empty($errors)) {
        if ($bookService->editBook($bookId, $bookData)) {
            redirect('/index.php');
        } else {
            $error = "Failed to edit the book";
        }
    } else {
        $error = implode('<br>', $errors);
    }
}

require_once ('./view/edit-book.php');