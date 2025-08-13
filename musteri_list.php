<?php
include 'db.php';
$musteriler = $pdo->query("SELECT * FROM musteri ORDER BY ad, soyad")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Müşteri Listesi</title>
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'navbar_sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>Müşteriler</h2>
        <a href="musteri_ekle.php" class="btn btn-success mb-2">Yeni Müşteri Ekle</a>
        <table class="table table-bordered table-striped">
          <thead>
            <tr><th>ID</th><th>Ad</th><th>Soyad</th><th>Email</th><th>Telefon</th><th>İşlemler</th></tr>
          </thead>
          <tbody>
            <?php foreach($musteriler as $m): ?>
            <tr>
              <td><?= $m['id'] ?></td>
              <td><?= $m['ad'] ?></td>
              <td><?= $m['soyad'] ?></td>
              <td><?= $m['email'] ?></td>
              <td><?= $m['telefon'] ?></td>
              <td>
                <a href="musteri_duzenle.php?id=<?= $m['id'] ?>" class="btn btn-primary btn-sm">Düzenle</a>
                <a href="musteri_sil.php?id=<?= $m['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Silmek istediğine emin misin?')">Sil</a>
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
