<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: musteri_list.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM musteri WHERE id = ?");
$stmt->execute([$id]);
$musteri = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$musteri) {
    header("Location: musteri_list.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad = $_POST['ad'] ?? '';
    $soyad = $_POST['soyad'] ?? '';
    $telefon = $_POST['telefon'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($ad && $soyad && $telefon && $email) {
        $stmt = $pdo->prepare("UPDATE musteri SET ad=?, soyad=?, telefon=?, email=? WHERE id=?");
        $stmt->execute([$ad, $soyad, $telefon, $email, $id]);
        header("Location: musteri_list.php");
        exit;
    } else {
        $hata = "Lütfen tüm alanları doldurun.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Müşteri Düzenle</title></head>
<body>
<h1>Müşteri Düzenle</h1>
<?php if (!empty($hata)): ?>
    <p style="color:red"><?= htmlspecialchars($hata) ?></p>
<?php endif; ?>
<form method="POST">
    Ad: <input type="text" name="ad" value="<?= htmlspecialchars($musteri['ad']) ?>" required><br><br>
    Soyad: <input type="text" name="soyad" value="<?= htmlspecialchars($musteri['soyad']) ?>" required><br><br>
    Telefon: <input type="text" name="telefon" value="<?= htmlspecialchars($musteri['telefon']) ?>" required><br><br>
    E-posta: <input type="email" name="email" value="<?= htmlspecialchars($musteri['email']) ?>" required><br><br>
    <button type="submit">Güncelle</button>
</form>
<a href="musteri_list.php">Müşteri Listesine Dön</a>
</body>
</html>
