<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

requireAdmin(); 

$pdo = getDB();

$stmt  = $pdo->query("SELECT user_id, full_name, email, phone, role, created_at FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();

$counts = $pdo->query("SELECT role, COUNT(*) as count FROM users GROUP BY role")->fetchAll();
$roleCounts = array_column($counts, 'count', 'role');

$pageTitle = 'Admin Panel';
require_once 'includes/header.php'; 
?>

<link rel="stylesheet" href="./styles/dashboard.css">
<link rel="stylesheet" href="./styles/admin.css">

<div class="container-wide">

    <header class="admin-header">
        <h2 class="page-title">🛠️ BakeEase Admin Panel</h2>
        <p class="page-sub">Restricted to authorized artisan administrators only. System integrity verified.</p>
    </header>

    <div class="dash-grid">
        <div class="stat-card">
            <h3>Total Accounts</h3>
            <div class="stat-value"><?= count($users) ?></div>
            <p>Registered users in DB</p>
        </div>
        <div class="stat-card">
            <h3>Customers</h3>
            <div class="stat-value" style="color: var(--success);">
                <?= $roleCounts['customer'] ?? 0 ?>
            </div>
            <p>Active shoppers</p>
        </div>
        <div class="stat-card">
            <h3>Staff/Admins</h3>
            <div class="stat-value" style="color: #991b1b;">
                <?= $roleCounts['admin'] ?? 0 ?>
            </div>
            <p>Privileged accounts</p>
        </div>
        <div class="stat-card">
            <h3>Active Admin</h3>
            <div class="stat-value" style="font-size:1rem"><?= clean($_SESSION['full_name']) ?></div>
            <p><?= clean($_SESSION['email']) ?></p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--primary);">User Directory</h3>
            <span class="text-xs" style="color: var(--text-sub);">Last Updated: <?= date('H:i:s') ?></span>
        </div>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Artisan/Customer Name</th>
                    <th>Email Address</th>
                    <th>Phone</th>
                    <th>Access Level</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding: 2rem;">No users found in database.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td><strong>#<?= $u['user_id'] ?></strong></td>
                        <td><?= clean($u['full_name']) ?></td>
                        <td><?= clean($u['email']) ?></td>
                        <td><?= clean($u['phone']) ?></td>
                        <td>
                            <span class="role-badge <?= $u['role'] ?>">
                                <?= clean($u['role']) ?>
                            </span>
                        </td>
                        <td><?= date('d M Y', strtotime($u['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="session-box mt-3">
        <h3>🔒 Security Protocol Audit</h3>
        <p style="font-size:.875rem; color: var(--text-sub); line-height: 1.8;">
            Access to this resource is granted because your session contains a valid <code>role</code> claim of <strong>admin</strong>. 
            The system has verified your <strong>Session ID:</strong> <code><?= session_id() ?></code>. 
            <br><br>
            <strong>Precautionary Note:</strong> All administrative actions are tied to your user ID (<code><?= $_SESSION['user_id'] ?></code>). 
            If you are on a shared workstation, ensure you logout to clear the server-side session and local cookies.
        </p>
    </div>

    <div style="margin-top: 2rem; display: flex; gap: 1rem;">
        <a href="dashboard.php" class="btn btn-outline" style="padding: 0.8rem 2rem;">
            ← Return to Dashboard
        </a>
        <a href="logout.php" class="btn btn-primary" style="padding: 0.8rem 2rem; background: #991b1b;">
            Secure Logout
        </a>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>