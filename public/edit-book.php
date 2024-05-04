<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;
use CT275\Labs\Services\BookService;

$userService = new UserService(createPDOInstance());
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

$bookId = $_GET['id'] ?? null;
if (empty($bookId)) {
    redirect('/index.php');
}

$bookService = new BookService(createPDOInstance(), $authorizedUser['id']);

$book = $bookService->getBookById($bookId);
if (empty($book)) {
    redirect('/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $bookService->validateBookData($_POST);

    if (empty($errors)) {
        $bookData = [
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'genre' => $_POST['genre'],
            'published_year' => $_POST['published_year'],
            'image_url' => $_POST['image_url']
        ];

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