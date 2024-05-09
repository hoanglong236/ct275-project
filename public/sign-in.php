<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Services\UserService;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userService = new UserService($pdo);

    $username = trim($_POST['username'] ?? '');
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

$data['pageTitle'] = 'Sign In';
$data['templateContent'] = 'components/sign-in-form.php';
require_once 'view/auth-template.php';