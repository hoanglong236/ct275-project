<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\UserService;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    include_once 'error.php';
    exit();
}

Authorization::redirectIfUnauthorized();

$userService = new UserService($pdo);
$userService->signOut();
redirect("/sign-in.php");