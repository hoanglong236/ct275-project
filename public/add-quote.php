<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\QuoteService;
use CT275\Labs\Services\UserService;

$userService = new UserService($pdo);
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quoteData = array_map('trim', $_POST);
    $quoteService = new QuoteService($pdo, $authorizedUser['id']);

    $errors = $quoteService->validateQuoteData($quoteData);
    if (empty($errors)) {
        if ($quoteService->addQuote($quoteData)) {
            redirect('/quotes.php');
        } else {
            $error = "Failed to add the quote";
        }
    } else {
        $error = implode('<br>', $errors);
    }
}

$data['pageTitle'] = 'Add Quote';
require_once 'view/add-quote.php';