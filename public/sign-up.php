<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userService = new UserService($pdo);

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $error = "All fields are required";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        if ($userService->usernameExists($username)) {
            $error = "Username already exists";
        } else {
            $userService->signUp($username, $password);
            redirect('/sign-in.php');
        }
    }
}

require_once ('./view/sign-up.php');