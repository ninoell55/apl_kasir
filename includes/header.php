<?php
require_once __DIR__ . '/../config/functions.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Aplikasi Kasir'; ?></title>
    <!-- ICON-Website -->
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL; ?>assets/images/logo_smk.png" />
    <!-- MyCSS -->
    <link href="<?= BASE_URL; ?>assets/css/output.css" rel="stylesheet">
    <!-- Icon -->
    <script src="<?= BASE_URL; ?>assets/js/lucide.min.js"></script>
    <!-- Chart -->
    <script src="<?= BASE_URL; ?>assets/js/chart.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/theme.css" />
</head>
<body>
