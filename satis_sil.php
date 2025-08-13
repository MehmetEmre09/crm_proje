<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if($id){
    $stmt = $pdo->prepare("DELETE FROM satis WHERE id=?");
    $stmt->execute([$id]);
}
header("Location: satis_list.php");
exit;
?>
