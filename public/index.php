<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\BookService;

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();

$bookService = new BookService($pdo, $authorizedUser['id']);
$books = $bookService->getAllBooks();

$data['pageTitle'] = 'Books Collection';
require_once 'view/index.php';