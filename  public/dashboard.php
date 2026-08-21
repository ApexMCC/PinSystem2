<?php
require 'config.php';

session_name($config['session_name']);
session_start();

if (empty($_SESSION['pin_auth']) || $_SESSION['pin_auth'] < time()) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body class="dashboard-page">

  <div class="bg-orb bg-orb-1"></div>
  <div class="bg-orb bg-orb-2"></div>
  <div class="bg-grid"></div>

  <header class="dash-header">
    <img src="assets/apx_logo_inverted.webp" alt="" class="dash-logo" />
    <span class="dash-brand">Dashboard</span>
    <div class="dash-header-actions">
      <a class="ghost-btn" href="logout.php">Sign out</a>
    </div>
  </header>

  <main class="dashboard">
    <h1 class="dashboard-title">Welcome</h1>
    <p class="dashboard-subtitle">You're in.</p>
  </main>

</body>
</html>