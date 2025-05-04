<?php
require_once __DIR__ . '/../src/bootstrap.php';

use CT275\Labs\Common\Authorization;
use CT275\Labs\Services\UserService;

Authorization::redirectIfUnauthorized();
Authorization::revokeUserAuthorization();

redirect('/sign-in.php');