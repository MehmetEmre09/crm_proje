<?php
include 'db.php';
$hata = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ad = $_POST['ad'] ?? '';
    $soyad = $_POST['soyad'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefon = $_POST['telefon'] ?? '';
    if($ad && $soyad && $email && $telefon){
        $stmt = $pdo->prepare("INSERT INTO musteri (ad, soyad, email, telefon) VALUES (?, ?, ?, ?)");
        $stmt->execute([$ad, $soyad, $email, $telefon]);
        header("Location: musteri_list.php");
        exit;
    } else { $hata = "Lütfen tüm alanları doldurun."; }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Yeni Müşteri Ekle</title>
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'navbar_sidebar.php'; ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>Yeni Müşteri Ekle</h2>
        <?php if($hata) echo "<div class='alert alert-danger'>$hata</div>"; ?>
        <form method="POST">
          <input type="text" name="ad" placeholder="Ad" class="form-control mb-2">
          <input type="text" name="soyad" placeholder="Soyad" class="form-control mb-2">
          <input type="email" name="email" placeholder="Email" class="form-control mb-2">
          <input type="text" name="telefon" placeholder="Telefon" class="form-control mb-2">
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
