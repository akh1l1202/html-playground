<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? clean($pageTitle) . ' — BakeEase' : 'BakeEase' ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar" style="display:flex; justify-content:space-between; align-items:center; text-align:center;">
    <a href="dashboard.php" class="nav-logo" style="margin: 0 auto;">🧁 BakeEase</a>

    <div class="nav-links" style="margin: 0 auto; text-align:center;">
        <?php if (isLoggedIn()): ?>
            <span class="nav-user">
                👤 <?= clean($_SESSION['full_name']) ?>
                <span class="role-badge <?= $_SESSION['role'] ?>"><?= clean($_SESSION['role']) ?></span>
            </span>
            &nbsp;|&nbsp;
            <a href="dashboard.php">Dashboard</a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                &nbsp;|&nbsp;
                <a href="admin.php">Admin Panel</a>
            <?php endif; ?>
            &nbsp;|&nbsp;
            <a href="logout.php" class="btn-logout">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            &nbsp;|&nbsp;
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>

<?php
$flash = getFlash();
if ($flash): ?>
    <div class="flash flash-<?= clean($flash['type']) ?>" style="text-align:center;">
        <?= clean($flash['message']) ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['msg'])): ?>
    <?php $urlMsgs = [
        'timeout'       => ['error',   'Your session timed out. Please log in again.'],
        'please_login'  => ['error',   'You must be logged in to view that page.'],
        'logged_out'    => ['success', 'You have been successfully logged out.'],
        'no_access'     => ['error',   'You do not have permission to view that page.'],
        'registered'    => ['success', 'Account created! Please log in.'],
    ];
    $msg = $_GET['msg'];
    if (isset($urlMsgs[$msg])): ?>
        <div class="flash flash-<?= $urlMsgs[$msg][0] ?>" style="text-align:center;">
            <?= $urlMsgs[$msg][1] ?>
        </div>
    <?php endif; ?>
<?php endif; ?>