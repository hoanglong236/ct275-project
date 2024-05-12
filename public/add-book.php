<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\BookService;

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();

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
$data['templateContent'] = 'components/add-book-form.php';
require_once 'view/entry-item-template.php';