<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if(!$id) { header("Location: musteri_list.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM musteri WHERE id = ?");
$stmt->execute([$id]);
$musteri = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$musteri) { header("Location: musteri_list.php"); exit; }

$hata = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ad = $_POST['ad'] ?? '';
    $soyad = $_POST['soyad'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefon = $_POST['telefon'] ?? '';
    if($ad && $soyad && $email && $telefon){
        $stmt = $pdo->prepare("UPDATE musteri SET ad=?, soyad=?, email=?, telefon=? WHERE id=?");
        $stmt->execute([$ad,$soyad,$email,$telefon,$id]);
        header("Location: musteri_list.php");
        exit;
    } else { $hata = "Lütfen tüm alanları doldurun."; }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Müşteri Düzenle</title>
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'navbar_sidebar.php'; ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>Müşteri Düzenle</h2>
        <?php if($hata) echo "<div class='alert alert-danger'>$hata</div>"; ?>
        <form method="POST">
          <input type="text" name="ad" value="<?= $musteri['ad'] ?>" class="form-control mb-2">
          <input type="text" name="soyad" value="<?= $musteri['soyad'] ?>" class="form-control mb-2">
          <input type="email" name="email" value="<?= $musteri['email'] ?>" class="form-control mb-2">
          <input type="text" name="telefon" value="<?= $musteri['telefon'] ?>" class="form-control mb-2">
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
