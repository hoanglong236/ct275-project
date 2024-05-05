<?php

require_once 'autoload.php';
require_once 'functions.php';

try {
    $pdo = (new CT275\Labs\Database\PDOFactory())->create();
} catch (\PDOException $ex) {
    error_log("Unable to connect to MySQL: {$ex->getMessage()}");
    echo 'An error occurred while connecting to the database. Please try again later.';
    exit;
}