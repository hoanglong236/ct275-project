<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\QuoteService;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    exit();
}

$quoteId = $_POST['id'] ?? null;
if (empty($quoteId)) {
    http_response_code(400);
    exit();
}

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();

$quoteService = new QuoteService($pdo, $authorizedUser['id']);
if ($quoteService->deleteQuote($quoteId)) {
    redirect("/quotes.php");
} else {
    http_response_code(500);
    exit();
}