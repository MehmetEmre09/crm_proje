<?php
require 'db.php';

$musteriler = $pdo->query("SELECT * FROM musteri ORDER BY ad, soyad")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $musteri_id = $_POST['musteri_id'] ?? null;
    $urun_adi = $_POST['urun_adi'] ?? '';
    $fiyat = $_POST['fiyat'] ?? '';
    $tarih = $_POST['tarih'] ?? '';

    if ($musteri_id && $urun_adi && $fiyat && $tarih) {
        $stmt = $pdo->prepare("INSERT INTO satis (musteri_id, urun_adi, fiyat, tarih) VALUES (?, ?, ?, ?)");
        $stmt->execute([$musteri_id, $urun_adi, $fiyat, $tarih]);
        header("Location: satis_list.php");
        exit;
    } else {
        $hata = "Lütfen tüm alanları doldurun.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Yeni Satış Ekle</title></head>
<body>
<h1>Yeni Satış Ekle</h1>
<?php if (!empty($hata)): ?>
    <p style="color:red"><?= htmlspecialchars($hata) ?></p>
<?php endif; ?>
<form method="POST">
    <label>Müşteri:</label>
    <select name="musteri_id" required>
        <option value="">-- Seçiniz --</option>
        <?php foreach ($musteriler as $m): ?>
            <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['ad'] . ' ' . $m['soyad']) ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <label>Ürün Adı:</label>
    <input type="text" name="urun_adi" required>
    <br><br>
    <label>Fiyat:</label>
    <input type="number" step="0.01" name="fiyat" required>
    <br><br>
    <label>Tarih:</label>
    <input type="date" name="tarih" required>
    <br><br>
    <button type="submit">Kaydet</button>
</form>
<a href="satis_list.php">Satış Listesine Dön</a>
</body>
</html>
