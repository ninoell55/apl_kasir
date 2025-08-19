<?php
// Halaman logout admin
require_once '../../config/functions.php';

$pageTitle = 'Halaman Logout Admin';

// Pengecekan SESSION ADMIN
if (!isset($_SESSION['login_users'])) {
    header('Location: login.php');
    exit;
}

$_SESSION = [];
session_unset();
session_destroy();

header('Location: login.php?logout=success');
exit;
