<?php
require 'config.php';

session_name($config['session_name']);
session_start();

$error = '';
$ok = false;

if (isset($_POST['pin'])) {
    $pin = trim($_POST['pin']);

    if (file_exists($config['pin_hash_file'])) {
        $hash = trim(file_get_contents($config['pin_hash_file']));
    } else {
        $hash = $config['default_pin_hash'];
    }

    if ($pin == '') {
        $error = 'Please enter your PIN.';
    } elseif (password_verify($pin, $hash)) {
        $_SESSION['pin_auth'] = time() + $config['session_days'] * 86400;
        $ok = true;
        header('Refresh: 0.4; url=dashboard.php');
    } else {
        $error = 'Invalid PIN.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Enter PIN</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body class="login-page">

  <div class="bg-orb bg-orb-1"></div>
  <div class="bg-orb bg-orb-2"></div>
  <div class="bg-grid"></div>

  <main class="login-card">
    <header class="login-header">
      <img src="assets/apx_logo_inverted.webp" alt="" class="login-logo" />
      <h1 class="login-title">Enter PIN</h1>
      <p class="login-subtitle">Enter your access PIN to continue.</p>
    </header>

    <form method="post" action="index.php">
      <input type="password" name="pin" id="pinInput" class="invite-input" placeholder="PIN"
             inputmode="numeric" pattern="[0-9]*" autocomplete="off" required />
      <button type="submit" class="primary-btn">Continue</button>
      <?php if ($error) { ?>
        <p class="message error"><?php echo htmlspecialchars($error); ?></p>
      <?php } elseif ($ok) { ?>
        <p class="message success">Access granted.</p>
      <?php } ?>
    </form>

    <div class="login-footer">
      <a class="text-btn subtle" href="admin.php">Admin</a>
    </div>
  </main>

</body>
</html>