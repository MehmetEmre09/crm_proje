<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad = $_POST['ad'] ?? '';
    $soyad = $_POST['soyad'] ?? '';
    $telefon = $_POST['telefon'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($ad && $soyad && $telefon && $email) {
        $stmt = $pdo->prepare("INSERT INTO musteri (ad, soyad, telefon, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$ad, $soyad, $telefon, $email]);
        header("Location: musteri_list.php");
        exit;
    } else {
        $hata = "Lütfen tüm alanları doldurun.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Yeni Müşteri Ekle</title></head>
<body>
<h1>Yeni Müşteri Ekle</h1>
<?php if (!empty($hata)): ?>
    <p style="color:red"><?= htmlspecialchars($hata) ?></p>
<?php endif; ?>
<form method="POST">
    Ad: <input type="text" name="ad" required><br><br>
    Soyad: <input type="text" name="soyad" required><br><br>
    Telefon: <input type="text" name="telefon" required><br><br>
    E-posta: <input type="email" name="email" required><br><br>
    <button type="submit">Kaydet</button>
</form>
<a href="musteri_list.php">Müşteri Listesine Dön</a>
</body>
</html>
