<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\UserService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleSignIn();
} else {
    showSignInPage();
}

function handleSignIn() {
    global $pdo;
    $userService = new UserService($pdo);

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        showSignInPage('Username and password are required.');
    } else {
        $authorizedUser = $userService->authenticate($username, $password);

        if ($authorizedUser) {
            Authorization::setAuthorizedUser($authorizedUser);
            redirect('/index.php');
        } else {
            showSignInPage('Invalid username or password.');
        }
    }
}

function showSignInPage(string $errorMessage = null) {
    $error = $errorMessage;
    $data['pageTitle'] = 'Sign In';
    $data['templateContent'] = 'components/sign-in-form.php';

    require_once 'view/auth-template.php';
}