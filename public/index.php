<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;
use CT275\Labs\Services\BookService;

$userService = new UserService($pdo);
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

$bookService = new BookService($pdo, $authorizedUser['id']);
$books = $bookService->getAllBooks();

$data['pageTitle'] = 'Books Collection';
require_once 'view/index.php';