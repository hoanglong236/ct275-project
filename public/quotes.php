<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\QuoteService;
use CT275\Labs\Services\UserService;

$userService = new UserService($pdo);
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

$searchTerm = trim($_GET['search_term'] ?? '');
$quoteService = new QuoteService($pdo, $authorizedUser['id']);

if (empty($searchTerm)) {
    $quotes = $quoteService->getAllQuotes();
} else {
    $quotes = $quoteService->searchQuotes($searchTerm);
}

$data['pageTitle'] = 'Quotes Collection';
require_once ('./view/quotes.php');