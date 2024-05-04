<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;
use CT275\Labs\Services\BookService;

$userService = new UserService(createPDOInstance());
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookService = new BookService(createPDOInstance(), $authorizedUser['id']);
    $errors = $bookService->validateBookData($_POST);

    if (empty($errors)) {
        $bookData = [
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'genre' => $_POST['genre'],
            'published_year' => $_POST['published_year'],
            'image_url' => $_POST['image_url']
        ];

        if ($bookService->addBook($bookData)) {
            redirect('/index.php');
        } else {
            $error = "Failed to add the book";
        }
    } else {
        $error = implode('<br>', $errors);
    }
}

require_once ('./view/add-book.php');