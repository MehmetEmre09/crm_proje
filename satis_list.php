<?php
include 'db.php';
$stmt = $pdo->query("SELECT satis.id, satis.urun_adi, satis.fiyat, satis.tarih, musteri.ad, musteri.soyad 
                     FROM satis INNER JOIN musteri ON satis.musteri_id = musteri.id ORDER BY satis.tarih DESC");
$satislar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Satış Listesi</title>
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'navbar_sidebar.php'; ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>Satışlar</h2>
        <a href="satis_ekle.php" class="btn btn-success mb-2">Yeni Satış Ekle</a>
        <table class="table table-bordered table-striped">
          <thead>
            <tr><th>ID</th><th>Müşteri</th><th>Ürün</th><th>Fiyat</th><th>Tarih</th><th>İşlemler</th></tr>
          </thead>
          <tbody>
            <?php foreach($satislar as $s): ?>
              <tr>
                <td><?= $s['id'] ?></td>
                <td><?= $s['ad'] ?> <?= $s['soyad'] ?></td>
                <td><?= $s['urun_adi'] ?></td>
                <td><?= $s['fiyat'] ?></td>
                <td><?= $s['tarih'] ?></td>
                <td>
                  <a href="satis_duzenle.php?id=<?= $s['id'] ?>" class="btn btn-primary btn-sm">Düzenle</a>
                  <a href="satis_sil.php?id=<?= $s['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğine emin misin?')">Sil</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
