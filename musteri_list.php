<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM musteri ORDER BY ad, soyad");
$musteriler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Müşteri Listesi</title>
</head>
<body>
    <h1>Müşteriler</h1>
    <a href="musteri_ekle.php">Yeni Müşteri Ekle</a> | <a href="index.php">Ana Sayfa</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th><th>Ad</th><th>Soyad</th><th>Telefon</th><th>E-posta</th><th>İşlemler</th>
        </tr>
        <?php foreach ($musteriler as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['id']) ?></td>
            <td><?= htmlspecialchars($m['ad']) ?></td>
            <td><?= htmlspecialchars($m['soyad']) ?></td>
            <td><?= htmlspecialchars($m['telefon']) ?></td>
            <td><?= htmlspecialchars($m['email']) ?></td>
            <td>
                <a href="musteri_duzenle.php?id=<?= $m['id'] ?>">Düzenle</a> |
                <a href="musteri_sil.php?id=<?= $m['id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
