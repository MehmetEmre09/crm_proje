<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if(!$id) { header("Location: satis_list.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM satis WHERE id=?");
$stmt->execute([$id]);
$satis = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$satis) { header("Location: satis_list.php"); exit; }

$musteriler = $pdo->query("SELECT * FROM musteri ORDER BY ad,soyad")->fetchAll(PDO::FETCH_ASSOC);
$hata = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $musteri_id = $_POST['musteri_id'] ?? null;
    $urun_adi = $_POST['urun_adi'] ?? '';
    $fiyat = $_POST['fiyat'] ?? '';
    $tarih = $_POST['tarih'] ?? '';
    if($musteri_id && $urun_adi && $fiyat && $tarih){
        $stmt = $pdo->prepare("UPDATE satis SET musteri_id=?, urun_adi=?, fiyat=?, tarih=? WHERE id=?");
        $stmt->execute([$musteri_id,$urun_adi,$fiyat,$tarih,$id]);
        header("Location: satis_list.php");
        exit;
    } else { $hata = "Lütfen tüm alanları doldurun."; }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Satış Düzenle</title>
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'navbar_sidebar.php'; ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>Satış Düzenle</h2>
        <?php if($hata) echo "<div class='alert alert-danger'>$hata</div>"; ?>
        <form method="POST">
          <select name="musteri_id" class="form-control mb-2">
            <option value="">Müşteri Seç</option>
            <?php foreach($musteriler as $m): ?>
              <option value="<?= $m['id'] ?>" <?= $m['id']==$satis['musteri_id']?'selected':'' ?>>
                <?= $m['ad'].' '.$m['soyad'] ?>
              </option>
            <?php endforeach; ?>
          </select>
          <input type="text" name="urun_adi" value="<?= $satis['urun_adi'] ?>" class="form-control mb-2">
          <input type="number" step="0.01" name="fiyat" value="<?= $satis['fiyat'] ?>" class="form-control mb-2">
          <input type="date" name="tarih" value="<?= $satis['tarih'] ?>" class="form-control mb-2">
          <button class="btn btn-primary">Güncelle</button>
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
