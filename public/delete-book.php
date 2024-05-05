<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;
use CT275\Labs\Services\BookService;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    include_once ('error.php');
    exit();
}

$bookId = $_POST['id'] ?? null;
if (empty($bookId)) {
    http_response_code(404);
    include_once ('error.php');
    exit();
}

$userService = new UserService($pdo);
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    http_response_code(401);
    include_once ('error.php');
    exit();
}

$bookService = new BookService($pdo, $authorizedUser['id']);
if ($bookService->deleteBook($bookId)) {
    redirect("/index.php");
} else {
    http_response_code(500);
    include_once ('error.php');
    exit();
}