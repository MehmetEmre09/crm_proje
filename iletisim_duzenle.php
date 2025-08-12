<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: iletisim_list.php");
    exit;
}

$musteriler = $pdo->query("SELECT * FROM musteri ORDER BY ad, soyad")->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM iletisim WHERE id = ?");
$stmt->execute([$id]);
$iletisim = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$iletisim) {
    header("Location: iletisim_list.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $musteri_id = $_POST['musteri_id'] ?? null;
    $note = $_POST['note'] ?? '';

    if ($musteri_id && $note) {
        $stmt = $pdo->prepare("UPDATE iletisim SET musteri_id=?, note=? WHERE id=?");
        $stmt->execute([$musteri_id, $note, $id]);
        header("Location: iletisim_list.php");
        exit;
    } else {
        $hata = "Lütfen tüm alanları doldurun.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>İletişim Notu Düzenle</title></head>
<body>
<h1>İletişim Notu Düzenle</h1>
<?php if (!empty($hata)): ?>
    <p style="color:red"><?= htmlspecialchars($hata) ?></p>
<?php endif; ?>
<form method="POST">
    <label>Müşteri:</label>
    <select name="musteri_id" required>
        <option value="">-- Seçiniz --</option>
        <?php foreach ($musteriler as $m): ?>
            <option value="<?= $m['id'] ?>" <?= $m['id'] == $iletisim['musteri_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['ad'] . ' ' . $m['soyad']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <label>Not:</label><br>
    <textarea name="note" rows="4" cols="50" required><?= htmlspecialchars($iletisim['note']) ?></textarea>
    <br><br>
    <button type="submit">Güncelle</button>
</form>
<a href="iletisim_list.php">İletişim Notları Listesine Dön</a>
</body>
</html>
