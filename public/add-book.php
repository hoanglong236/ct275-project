<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;
use CT275\Labs\Services\BookService;

$userService = new UserService($pdo);
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookData = array_map('trim', $_POST);
    $bookService = new BookService($pdo, $authorizedUser['id']);

    $errors = $bookService->validateBookData($bookData);
    if (empty($errors)) {
        if ($bookService->addBook($bookData)) {
            redirect('/index.php');
        } else {
            $error = "Failed to add the book";
        }
    } else {
        $error = implode('<br>', $errors);
    }
}

$data['pageTitle'] = 'Add Book';
require_once ('./view/add-book.php');