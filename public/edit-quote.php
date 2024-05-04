<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\QuoteService;
use CT275\Labs\Services\UserService;

$userService = new UserService(createPDOInstance());
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

$quoteId = $_GET['id'] ?? null;
if (empty($quoteId)) {
    redirect('/index.php');
}

$quoteService = new QuoteService(createPDOInstance(), $authorizedUser['id']);

$quote = $quoteService->getQuoteById($quoteId);
if (empty($quote)) {
    redirect('/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $quoteService->validateQuoteData($_POST);

    if (empty($errors)) {
        $quoteData = [
            'quote_text' => $_POST['quote_text'],
            'author' => $_POST['author'],
        ];

        if ($quoteService->editQuote($quoteId, $quoteData)) {
            redirect('/quotes.php');
        } else {
            $error = "Failed to edit the quote";
        }
    } else {
        $error = implode('<br>', $errors);
    }
}

require_once ('./view/edit-quote.php');