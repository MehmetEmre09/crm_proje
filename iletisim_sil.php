<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if($id){
    $stmt = $pdo->prepare("DELETE FROM iletisim WHERE id=?");
    $stmt->execute([$id]);
}
header("Location: iletisim_list.php");
exit;
?>
