<?php
include 'db.php';
$stmt = $pdo->query("SELECT iletisim.id, iletisim.note, iletisim.created_at, musteri.ad, musteri.soyad 
                     FROM iletisim INNER JOIN musteri ON iletisim.musteri_id = musteri.id 
                     ORDER BY iletisim.created_at DESC");
$iletisimler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>İletişim Notları</title>
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'navbar_sidebar.php'; ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>İletişim Notları</h2>
        <a href="iletisim_ekle.php" class="btn btn-success mb-2">Yeni Not Ekle</a>
        <table class="table table-bordered table-striped">
          <thead>
            <tr><th>ID</th><th>Müşteri</th><th>Not</th><th>Tarih</th><th>İşlemler</th></tr>
          </thead>
          <tbody>
            <?php foreach($iletisimler as $i): ?>
            <tr>
              <td><?= $i['id'] ?></td>
              <td><?= $i['ad'] ?> <?= $i['soyad'] ?></td>
              <td><?= $i['note'] ?></td>
              <td><?= $i['created_at'] ?></td>
              <td>
                <a href="iletisim_duzenle.php?id=<?= $i['id'] ?>" class="btn btn-primary btn-sm">Düzenle</a>
                <a href="iletisim_sil.php?id=<?= $i['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğine emin misin?')">Sil</a>
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
