<?php
require 'db.php';

$stmt = $pdo->query("
    SELECT iletisim.id, iletisim.note, iletisim.created_at, musteri.ad, musteri.soyad
    FROM iletisim
    INNER JOIN musteri ON iletisim.musteri_id = musteri.id
    ORDER BY iletisim.created_at DESC
");

$iletisimler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>İletişim Notları</title></head>
<body>
<h1>İletişim Notları</h1>
<a href="iletisim_ekle.php">Yeni İletişim Notu Ekle</a> | <a href="index.php">Ana Sayfa</a>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th><th>Müşteri</th><th>Not</th><th>Tarih</th><th>İşlemler</th>
</tr>
<?php foreach ($iletisimler as $i): ?>
<tr>
    <td><?= htmlspecialchars($i['id']) ?></td>
    <td><?= htmlspecialchars($i['ad'] . ' ' . $i['soyad']) ?></td>
    <td><?= htmlspecialchars($i['note']) ?></td>
    <td><?= htmlspecialchars($i['created_at']) ?></td>
    <td>
        <a href="iletisim_duzenle.php?id=<?= $i['id'] ?>">Düzenle</a> |
        <a href="iletisim_sil.php?id=<?= $i['id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
