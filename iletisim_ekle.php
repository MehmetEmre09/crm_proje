<?php
require 'db.php';

$musteriler = $pdo->query("SELECT * FROM musteri ORDER BY ad, soyad")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $musteri_id = $_POST['musteri_id'] ?? null;
    $note = $_POST['note'] ?? '';

    if ($musteri_id && $note) {
        $stmt = $pdo->prepare("INSERT INTO iletisim (musteri_id, note, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$musteri_id, $note]);
        header("Location: iletisim_list.php");
        exit;
    } else {
        $hata = "Lütfen tüm alanları doldurun.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Yeni İletişim Notu Ekle</title></head>
<body>
<h1>Yeni İletişim Notu Ekle</h1>
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
    <label>Not:</label><br>
    <textarea name="note" rows="4" cols="50" required></textarea>
    <br><br>
    <button type="submit">Kaydet</button>
</form>
<a href="iletisim_list.php">İletişim Notları Listesine Dön</a>
</body>
</html>
