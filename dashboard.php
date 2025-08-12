<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h2>Hoşgeldin, <?= htmlspecialchars($_SESSION['username']) ?></h2>
<p>Burası korumalı sayfa, sadece giriş yapanlar görebilir.</p>
<a href="logout.php">Çıkış Yap</a>
</body>
</html>
