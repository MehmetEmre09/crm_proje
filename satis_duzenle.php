<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: satis_list.php");
    exit;
}

$musteriler = $pdo->query("SELECT * FROM musteri ORDER BY ad, soyad")->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM satis WHERE id = ?");
$stmt->execute([$id]);
$satis = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$satis) {
    header("Location: satis_list.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $musteri_id = $_POST['musteri_id'] ?? null;
    $urun_adi = $_POST['urun_adi'] ?? '';
    $fiyat = $_POST['fiyat'] ?? '';
    $tarih = $_POST['tarih'] ?? '';

    if ($musteri_id && $urun_adi && $fiyat && $tarih) {
        $stmt = $pdo->prepare("UPDATE satis SET musteri_id=?, urun_adi=?, fiyat=?, tarih=? WHERE id=?");
        $stmt->execute([$musteri_id, $urun_adi, $fiyat, $tarih, $id]);
        header("Location: satis_list.php");
        exit;
    } else {
        $hata = "Lütfen tüm alanları doldurun.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Satış Düzenle</title></head>
<body>
<h1>Satış Düzenle</h1>
<?php if (!empty($hata)): ?>
    <p style="color:red"><?= htmlspecialchars($hata) ?></p>
<?php endif; ?>
<form method="POST">
    <label>Müşteri:</label>
    <select name="musteri_id" required>
        <option value="">-- Seçiniz --</option>
        <?php foreach ($musteriler as $m): ?>
            <option value="<?= $m['id'] ?>" <?= $m['id'] == $satis['musteri_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['ad'] . ' ' . $m['soyad']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <label>Ürün Adı:</label>
    <input type="text" name="urun_adi" value="<?= htmlspecialchars($satis['urun_adi']) ?>" required>
    <br><br>
    <label>Fiyat:</label>
    <input type="number" step="0.01" name="fiyat" value="<?= htmlspecialchars($satis['fiyat']) ?>" required>
    <br><br>
    <label>Tarih:</label>
    <input type="date" name="tarih" value="<?= htmlspecialchars($satis['tarih']) ?>" required>
    <br><br>
    <button type="submit">Güncelle</button>
</form>
<a href="satis_list.php">Satış Listesine Dön</a>
</body>
</html>
