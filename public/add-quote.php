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
    $quoteService = new QuoteService($pdo, $authorizedUser['id']);
    $errors = $quoteService->validateQuoteData($_POST);

    if (empty($errors)) {
        $quoteData = [
            'user_id' => $authorizedUser['id'],
            'quote_text' => $_POST['quote_text'],
            'author' => $_POST['author'],
        ];

        if ($quoteService->addQuote($quoteData)) {
            redirect('/quotes.php');
        } else {
            $error = "Failed to add the quote";
        }
    } else {
        $error = implode('<br>', $errors);
    }
}

require_once ('./view/add-quote.php');