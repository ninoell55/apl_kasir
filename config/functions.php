<?php
// Start the session if it hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// base_url for the application
define('BASE_URL', 'http://localhost/apl_kasir/');