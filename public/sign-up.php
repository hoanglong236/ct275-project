<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleSignUp();
} else {
    showSignUpPage();
}

function handleSignUp() {
    global $pdo;
    $userService = new UserService($pdo);

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    if (empty($username) || empty($password) || empty($confirmPassword)) {
        showSignUpPage('All fields are required.');

    } elseif ($password !== $confirmPassword) {
        showSignUpPage('Password does not match.');

    } elseif ($userService->usernameExists($username)) {
        showSignUpPage('Username already exists.');

    } else {
        $userService->signUp($username, $password);
        redirect('/sign-in.php');
    }
}

function showSignUpPage(string $errorMessage = null) {
    $error = $errorMessage;
    $data['pageTitle'] = 'Sign Up';
    $data['templateContent'] = 'components/sign-up-form.php';

    require_once 'view/auth-template.php';
}