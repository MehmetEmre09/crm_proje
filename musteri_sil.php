<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM musteri WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: musteri_list.php");
exit;
