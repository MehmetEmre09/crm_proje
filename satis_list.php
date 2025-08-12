<?php
require 'db.php';

$stmt = $pdo->query("
    SELECT satis.id, satis.urun_adi, satis.fiyat, satis.tarih, musteri.ad, musteri.soyad
    FROM satis
    INNER JOIN musteri ON satis.musteri_id = musteri.id
    ORDER BY satis.tarih DESC
");
$satislar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Satış Listesi</title></head>
<body>
<h1>Satışlar</h1>
<a href="satis_ekle.php">Yeni Satış Ekle</a> | <a href="index.php">Ana Sayfa</a>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th><th>Müşteri</th><th>Ürün</th><th>Fiyat</th><th>Tarih</th><th>İşlemler</th>
</tr>
<?php foreach ($satislar as $s): ?>
<tr>
    <td><?= htmlspecialchars($s['id']) ?></td>
    <td><?= htmlspecialchars($s['ad'] . ' ' . $s['soyad']) ?></td>
    <td><?= htmlspecialchars($s['urun_adi']) ?></td>
    <td><?= htmlspecialchars($s['fiyat']) ?></td>
    <td><?= htmlspecialchars($s['tarih']) ?></td>
    <td>
        <a href="satis_duzenle.php?id=<?= $s['id'] ?>">Düzenle</a> |
        <a href="satis_sil.php?id=<?= $s['id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
