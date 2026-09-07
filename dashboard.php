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
<body class="dashboard-page wall-page">

  <div class="bg-orb bg-orb-1"></div>
  <div class="bg-orb bg-orb-2"></div>
  <div class="bg-grid"></div>

  <!-- ===== Ops Wall ===== -->
  <!-- Five-box dashboard:
       1  Floor plan     left column, tall
       2  Data table     right column, top third
       3  Camera feed    right column, middle third
       4  Camera feed    right column, bottom third
       5  Sector status  left column, short bottom bar   -->
  <main class="dash-wall">
    <div class="wall-col wall-col--left">
      <!-- Box 1: Floor plan -->
      <section class="wall-box wall-box--map" id="wallMap">
        <span class="wall-name">Floor Plan</span>
        <span class="wall-meta">Sector Overview</span>
      </section>

      <!-- Box 5: Sector status -->
      <section class="wall-box wall-box--status" id="wallStatus">
        <div class="wall-status-row">
          <div class="stat-col stat-col--green" data-stat="A"></div>
          <div class="stat-col stat-col--orange" data-stat="B"></div>
          <div class="stat-col stat-col--orange" data-stat="C"></div>
          <div class="stat-col stat-col--green" data-stat="D"></div>
          <div class="stat-col stat-col--red" data-stat="E"></div>
        </div>
      </section>
    </div>

    <div class="wall-col wall-col--right">
      <!-- Box 2: Data table -->
      <section class="wall-box wall-box--table" id="wallTable">
        <span class="wall-name">Data Table</span>
        <span class="wall-meta">Records</span>
      </section>

      <!-- Box 3: Camera feed -->
      <section class="wall-box wall-box--cam" id="wallCam1">
        <span class="wall-name">Cam 01</span>
      </section>

      <!-- Box 4: Camera feed -->
      <section class="wall-box wall-box--cam" id="wallCam2">
        <span class="wall-name">Cam 02</span>
      </section>
    </div>
  </main>

  <a class="wall-logout" href="logout.php">Sign out</a>

</body>
</html>
