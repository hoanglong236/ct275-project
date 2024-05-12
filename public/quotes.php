<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\QuoteService;

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();

$searchTerm = trim($_GET['search_term'] ?? '');
$quoteService = new QuoteService($pdo, $authorizedUser['id']);

if (empty($searchTerm)) {
    $quotes = $quoteService->getAllQuotes();
} else {
    $quotes = $quoteService->searchQuotes($searchTerm);
}

$data['pageTitle'] = 'Quotes Collection';
require_once 'view/quotes.php';