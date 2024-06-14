<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\QuoteService;

Authorization::redirectIfUnauthorized();
$authorizedUser = Authorization::getAuthorizedUser();
$quoteService = new QuoteService($pdo, $authorizedUser['id']);

$criteria = [];
$criteria['perPage'] = 20;
$criteria['page'] = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$criteria['searchTerm'] = trim($_GET['search_term'] ?? '');

$quotes = $quoteService->searchQuotesWithCriteria($criteria);

$data['pageTitle'] = 'Quotes Collection';
$data['quotes'] = $quotes;
$data['searchTerm'] = $criteria['searchTerm'];

require_once 'view/quotes.php';