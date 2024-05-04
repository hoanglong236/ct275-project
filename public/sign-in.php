<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userService = new UserService(createPDOInstance());

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Username and password are required";
    } else {
        $authorizedUser = $userService->authenticate($username, $password);

        if ($authorizedUser) {
            $userService->setAuthorizedUser($authorizedUser);
            redirect('/index.php');
        } else {
            $error = "Invalid username or password";
        }
    }
}

require_once ('./view/sign-in.php');