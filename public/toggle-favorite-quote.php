<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\QuoteService;
use CT275\Labs\Services\UserService;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    include_once ('error.php');
    exit();
}

$quoteId = $_POST['id'] ?? null;
if (empty($quoteId)) {
    http_response_code(404);
    include_once ('error.php');
    exit();
}

$userService = new UserService(createPDOInstance());
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    http_response_code(401);
    include_once ('error.php');
    exit();
}

$quoteService = new QuoteService(createPDOInstance(), $authorizedUser['id']);
if ($quoteService->toggleFavoriteQuote($quoteId)) {
    redirect("/quotes.php");
} else {
    http_response_code(500);
    include_once ('error.php');
    exit();
}