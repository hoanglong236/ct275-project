<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\QuoteService;
use CT275\Labs\Services\UserService;

$userService = new UserService($pdo);
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    redirect('/sign-in.php');
}

$quoteId = $_GET['id'] ?? null;
if (empty($quoteId)) {
    redirect('/index.php');
}

$quoteService = new QuoteService($pdo, $authorizedUser['id']);

$quote = $quoteService->getQuoteById($quoteId);
if (empty($quote)) {
    redirect('/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quoteData = array_map('trim', $_POST);

    $errors = $quoteService->validateQuoteData($quoteData);
    if (empty($errors)) {
        if ($quoteService->editQuote($quoteId, $quoteData)) {
            redirect('/quotes.php');
        } else {
            $error = "Failed to edit the quote";
        }
    } else {
        $error = implode('<br>', $errors);
    }
}

$data['pageTitle'] = 'Edit Quote';
$data['templateContent'] = 'components/edit-quote-form.php';
require_once 'view/entry-item-template.php';