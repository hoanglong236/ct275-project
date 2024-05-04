<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    include_once ('error.php');
    exit();
}

$userService = new UserService(createPDOInstance());
$authorizedUser = $userService->getAuthorizedUser();
if (empty($authorizedUser['id'])) {
    http_response_code(401);
    include_once ('error.php');
    exit();
}

$userService->signOut();
redirect("/sign-in.php");
