<?php
include 'db.php';
$hata = '';
$musteriler = $pdo->query("SELECT * FROM musteri ORDER BY ad, soyad")->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $musteri_id = $_POST['musteri_id'] ?? null;
    $urun_adi = $_POST['urun_adi'] ?? '';
    $fiyat = $_POST['fiyat'] ?? '';
    $tarih = $_POST['tarih'] ?? '';

    if($musteri_id && $urun_adi && $fiyat && $tarih){
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
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Yeni Satış Ekle</title>
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'navbar_sidebar.php'; ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>Yeni Satış Ekle</h2>
        <?php if($hata) echo "<div class='alert alert-danger'>$hata</div>"; ?>
        <form method="POST">
          <select name="musteri_id" class="form-control mb-2">
            <option value="">Müşteri Seç</option>
            <?php foreach($musteriler as $m): ?>
              <option value="<?= $m['id'] ?>"><?= $m['ad'] ?> <?= $m['soyad'] ?></option>
            <?php endforeach; ?>
          </select>
          <input type="text" name="urun_adi" placeholder="Ürün Adı" class="form-control mb-2">
          <input type="number" step="0.01" name="fiyat" placeholder="Fiyat" class="form-control mb-2">
          <input type="date" name="tarih" class="form-control mb-2">
          <button class="btn btn-success">Kaydet</button>
        </form>
      </div>
    </section>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
