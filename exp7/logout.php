<?php
require_once 'config/db.php';
require_once 'includes/auth.php';

logoutUser();   // destroys session + deletes cookie + removes DB token

header("Location: login.php?msg=logged_out");
exit();
?>