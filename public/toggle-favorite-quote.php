<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\QuoteService;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    include_once 'error.php';
    exit();
}

$quoteId = $_POST['id'] ?? null;
if (empty($quoteId)) {
    http_response_code(404);
    include_once 'error.php';
    exit();
}

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();

$quoteService = new QuoteService($pdo, $authorizedUser['id']);
if ($quoteService->toggleFavoriteQuote($quoteId)) {
    redirect("/quotes.php");
} else {
    http_response_code(500);
    include_once 'error.php';
    exit();
}