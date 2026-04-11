<?php
?>
<footer class="footer" style="text-align: center;">
    <p>🧁 BakeEase &copy; 2026 &nbsp;|&nbsp; Web Programming Lab — Experiment 7</p>

    <?php if (isLoggedIn()): ?>
        <p class="session-info">
            Session started: <?= clean($_SESSION['login_time']) ?>
            &nbsp;|&nbsp;
            Role: <?= clean($_SESSION['role']) ?>
            &nbsp;|&nbsp;
            <a href="logout.php">Logout</a>
        </p>
    <?php endif; ?>
</footer>
</body>
</html>