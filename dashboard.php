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

  <!-- ===== Top Navbar ===== -->
  <nav class="navbar">
    <div class="navbar-left">
      <button class="navbar-menu-btn" id="menuToggle" aria-label="Open menu">
        <span class="menu-pill"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">
        <img src="https://us-east-1.tixte.net/uploads/cdn1.apexmcc.org/apx_logo.png" alt="Apex MCC" class="navbar-logo" />
        <span class="navbar-brand-text">Apex MCC</span>
      </a>
    </div>

    <div class="navbar-right">
      <div class="navbar-links">
        <a href="dashboard.php" class="navbar-link active">Dashboard</a>
        <a href="admin.php" class="navbar-link">Admin</a>
      </div>
      <a class="navbar-cta" href="logout.php">Sign out</a>
    </div>
  </nav>

  <!-- ===== Slide-out Drawer (LEFT) ===== -->
  <div class="drawer-overlay" id="drawerOverlay"></div>
  <aside class="drawer drawer-left" id="drawer">
    <div class="drawer-header">
      <img src="https://us-east-1.tixte.net/uploads/cdn1.apexmcc.org/apx_logo.png" alt="" class="drawer-logo" />
      <button class="drawer-close" id="drawerClose" aria-label="Close menu">&times;</button>
    </div>

    <div class="drawer-body">
      <section class="drawer-section">
        <h4 class="drawer-section-title">APEX MCC</h4>
        <a href="dashboard.php" class="drawer-link">Dashboard</a>
        <a href="admin.php" class="drawer-link">Admin</a>
      </section>

      <section class="drawer-section">
        <h4 class="drawer-section-title">RESOURCES</h4>
        <a href="dashboard.php" class="drawer-link">Handbook</a>
        <a href="dashboard.php" class="drawer-link">Playbook</a>
        <a href="dashboard.php" class="drawer-link">Mission &amp; Values</a>
        <a href="dashboard.php" class="drawer-link">Culture</a>
      </section>

      <section class="drawer-section">
        <h4 class="drawer-section-title">FOLLOW US</h4>
        <a href="#" class="drawer-link">Instagram</a>
        <a href="#" class="drawer-link">LinkedIn</a>
        <a href="#" class="drawer-link">GitHub</a>
        <a href="#" class="drawer-link">YouTube</a>
      </section>
    </div>

    <div class="drawer-footer">
      <a class="drawer-cta" href="logout.php">Sign out</a>
    </div>
  </aside>

  <!-- ===== Main Content ===== -->
  <main class="dashboard">
    <h1 class="dashboard-title">Welcome</h1>
    <p class="dashboard-subtitle">You're in.</p>

    <div class="dash-section">
      <div class="dash-grid">
        <div class="dash-card">
          <div class="dash-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
          </div>
          <div class="dash-card-title">Overview</div>
          <div class="dash-card-body">View your key metrics and performance data at a glance.</div>
        </div>
        <div class="dash-card">
          <div class="dash-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
          </div>
          <div class="dash-card-title">Schedule</div>
          <div class="dash-card-body">Manage upcoming events, meetings, and deadlines.</div>
        </div>
        <div class="dash-card">
          <div class="dash-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <div class="dash-card-title">Team</div>
          <div class="dash-card-body">Browse the staff directory and contact information.</div>
        </div>
      </div>
    </div>
  </main>

  <script>
    const menuToggle = document.getElementById('menuToggle');
    const drawer = document.getElementById('drawer');
    const overlay = document.getElementById('drawerOverlay');
    const closeBtn = document.getElementById('drawerClose');

    function openDrawer() {
      drawer.classList.add('open');
      overlay.classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeDrawer() {
      drawer.classList.remove('open');
      overlay.classList.remove('open');
      document.body.style.overflow = '';
    }

    menuToggle.addEventListener('click', openDrawer);
    closeBtn.addEventListener('click', closeDrawer);
    overlay.addEventListener('click', closeDrawer);
  </script>

</body>
</html>
