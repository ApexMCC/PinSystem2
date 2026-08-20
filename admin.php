<?php
require 'config.php';

session_name($config['session_name']);
session_start();

$msg = '';
$isError = false;

if (isset($_POST['current'])) {
    $current = trim($_POST['current']);
    $new = trim($_POST['new']);
    $confirm = trim($_POST['confirm']);

    if (file_exists($config['pin_hash_file'])) {
        $hash = trim(file_get_contents($config['pin_hash_file']));
    } else {
        $hash = $config['default_pin_hash'];
    }

    if ($current == '' || $new == '' || $confirm == '') {
        $msg = 'All fields are required.';
        $isError = true;
    } elseif (!password_verify($current, $hash)) {
        $msg = 'Current PIN is incorrect.';
        $isError = true;
    } elseif ($new != $confirm) {
        $msg = 'New PINs do not match.';
        $isError = true;
    } elseif (strlen($new) < 4 || !ctype_digit($new)) {
        $msg = 'New PIN must be at least 4 digits.';
        $isError = true;
    } else {
        $ok = file_put_contents($config['pin_hash_file'], password_hash($new, PASSWORD_BCRYPT));
        if ($ok) {
            $msg = 'PIN changed successfully.';
        } else {
            $msg = 'Could not save the PIN. Check file permissions.';
            $isError = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Change PIN</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body class="login-page">

  <div class="bg-orb bg-orb-1"></div>
  <div class="bg-orb bg-orb-2"></div>
  <div class="bg-grid"></div>

  <main class="login-card">
    <header class="login-header">
      <h1 class="login-title">Change PIN</h1>
      <p class="login-subtitle">You need the current PIN to set a new one.</p>
    </header>

    <form method="post" action="admin.php">
      <input type="password" name="current" class="invite-input" placeholder="Current PIN"
             inputmode="numeric" pattern="[0-9]*" autocomplete="off" required />
      <input type="password" name="new" class="invite-input" placeholder="New PIN"
             inputmode="numeric" pattern="[0-9]*" autocomplete="off" required />
      <input type="password" name="confirm" class="invite-input" placeholder="Confirm new PIN"
             inputmode="numeric" pattern="[0-9]*" autocomplete="off" required />
      <button type="submit" class="primary-btn">Change PIN</button>
      <?php if ($msg) { ?>
        <p class="message <?php echo $isError ? 'error' : 'success'; ?>"><?php echo htmlspecialchars($msg); ?></p>
      <?php } ?>
    </form>

    <div class="login-footer">
      <a class="text-btn" href="index.php">Back</a>
    </div>
  </main>

</body>
</html>