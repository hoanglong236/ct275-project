<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\QuoteService;
use CT275\Labs\Services\UserService;

$userService = new UserService(createPDOInstance());
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

$searchTerm = '';
$quoteService = new QuoteService(createPDOInstance(), $authorizedUser['id']);
$quotes = $quoteService->getAllQuotes();

require_once ('./view/quotes.php');