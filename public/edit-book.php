<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\BookService;

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();

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

$data['pageTitle'] = 'Edit Book';
$data['templateContent'] = 'components/edit-book-form.php';
require_once 'view/entry-item-template.php';