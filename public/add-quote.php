<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\QuoteService;

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();

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
$data['templateContent'] = 'components/add-quote-form.php';
require_once 'view/entry-item-template.php';