<?php
// Get the error status code (401 or 404)
$status_code = http_response_code();

// Set the error message based on the status code
$error_message = '';
if ($status_code === 401) {
    $error_message = '401 Unauthorized - You are not authorized to access this page.';
} elseif ($status_code === 404) {
    $error_message = '404 Not Found - The requested page does not exist.';
} else {
    $error_message = 'An error occurred.';
}

require_once ('./view/error.php');