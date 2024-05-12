<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\BookService;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    exit();
}

$bookId = $_POST['id'] ?? null;
if (empty($bookId)) {
    http_response_code(400);
    exit();
}

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();

$bookService = new BookService($pdo, $authorizedUser['id']);
if ($bookService->deleteBook($bookId)) {
    redirect("/index.php");
} else {
    http_response_code(500);
    exit();
}