<?php

require_once 'config/db.php';
require_once 'includes/auth.php';

requireLogin(); 

$pdo  = getDB();
$user = getUser();

$stmt = $pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$orderCount = $stmt->fetchColumn();
$cookieActive = isset($_COOKIE[REMEMBER_COOKIE]);
$elapsed = time() - $_SESSION['last_activity'];
$remaining = SESSION_TIMEOUT - $elapsed;
$minutesLeft = max(0, floor($remaining / 60));
$secondsLeft = max(0, $remaining % 60);

$pageTitle = 'Dashboard';
require_once 'includes/header.php';
?>

<div class="container-wide">
    <link rel="stylesheet" href="./styles/dashboard.css">

    <h2 class="page-title">
        Welcome back, <?= clean($_SESSION['full_name']) ?>! 🧁
    </h2>
    <p class="page-sub">Here's your account overview and active session details.</p>

    <div class="dash-grid">
        <div class="stat-card">
            <h3>Total Orders</h3>
            <div class="stat-value"><?= $orderCount ?></div>
            <p>Lifetime orders placed</p>
        </div>
        <div class="stat-card">
            <h3>Account Role</h3>
            <div class="stat-value" style="font-size:1.3rem;text-transform:capitalize">
                <?= clean($_SESSION['role']) ?>
            </div>
            <p>Your access level</p>
        </div>
        <div class="stat-card">
            <h3>Session Timeout</h3>
            <div class="stat-value" style="font-size:1.3rem">
                <?= $minutesLeft ?>m <?= $secondsLeft ?>s
            </div>
            <p>Remaining idle time</p>
        </div>
        <div class="stat-card">
            <h3>Remember Me</h3>
            <div class="stat-value" style="font-size:1.3rem;color:<?= $cookieActive ? 'var(--success)' : 'var(--text-2)' ?>">
                <?= $cookieActive ? 'Active' : 'Off' ?>
            </div>
            <p><?= $cookieActive ? REMEMBER_ME_DAYS . '-day cookie set' : 'Not enabled' ?></p>
        </div>
    </div>

    <div class="session-box">
        <h3>🔐 Active PHP Session Data ($_SESSION)</h3>
        <table class="data-table">
            <tr><th width="200">Key</th><th>Value</th></tr>
            <tr><td><strong>session_id</strong></td><td><?= session_id() ?></td></tr>
            <tr><td><strong>user_id</strong></td><td><?= clean($_SESSION['user_id']) ?></td></tr>
            <tr><td><strong>full_name</strong></td><td><?= clean($_SESSION['full_name']) ?></td></tr>
            <tr><td><strong>email</strong></td><td><?= clean($_SESSION['email']) ?></td></tr>
            <tr><td><strong>role</strong></td><td><?= clean($_SESSION['role']) ?></td></tr>
            <tr><td><strong>login_time</strong></td><td><?= clean($_SESSION['login_time']) ?></td></tr>
            <tr><td><strong>last_activity</strong></td><td><?= date('Y-m-d H:i:s', $_SESSION['last_activity']) ?></td></tr>
            <tr><td><strong>timeout_in</strong></td><td><?= $minutesLeft ?> min <?= $secondsLeft ?> sec</td></tr>
        </table>
    </div>

    <div class="cookie-box">
        <h3>🍪 Cookie Status ($_COOKIE)</h3>
        <?php if ($cookieActive): ?>
            <table class="data-table">
                <tr><th width="200">Cookie Name</th><th>Value (truncated)</th><th>Expires</th></tr>
                <tr>
                    <td><strong><?= REMEMBER_COOKIE ?></strong></td>
                    <td><?= clean(substr($_COOKIE[REMEMBER_COOKIE], 0, 20)) ?>…</td>
                    <td><?= date('d M Y', time() + REMEMBER_ME_DAYS * 86400) ?> (<?= REMEMBER_ME_DAYS ?> days)</td>
                </tr>
                <?php if (isset($_COOKIE['PHPSESSID'])): ?>
                <tr>
                    <td><strong>PHPSESSID</strong></td>
                    <td><?= clean(substr($_COOKIE['PHPSESSID'], 0, 20)) ?>…</td>
                    <td>Session end (browser close)</td>
                </tr>
                <?php endif; ?>
            </table>
            <p style="margin-top:.75rem;font-size:.8rem;color:#27500A">
                ✅ Remember Me cookie is active. You will be automatically logged back in for <?= REMEMBER_ME_DAYS ?> days even after closing your browser.
            </p>
        <?php else: ?>
            <p style="color:var(--text-2);font-size:.875rem">
                No Remember Me cookie is set. You chose not to enable it at login, or your cookie has expired.
                Your session will end when you close the browser.
            </p>
        <?php endif; ?>
    </div>

    <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:1.5rem">
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="admin.php" class="btn btn-primary" style="width:auto;padding:.7rem 1.5rem">
                Go to Admin Panel →
            </a>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-outline" style="width:auto;padding:.7rem 1.5rem">
            Logout
        </a>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>