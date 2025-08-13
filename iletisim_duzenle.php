<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if(!$id) { header("Location: iletisim_list.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM iletisim WHERE id=?");
$stmt->execute([$id]);
$iletisim = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$iletisim) { header("Location: iletisim_list.php"); exit; }

$musteriler = $pdo->query("SELECT * FROM musteri ORDER BY ad,soyad")->fetchAll(PDO::FETCH_ASSOC);
$hata = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $musteri_id = $_POST['musteri_id'] ?? null;
    $note = $_POST['note'] ?? '';
    if($musteri_id && $note){
        $stmt = $pdo->prepare("UPDATE iletisim SET musteri_id=?, note=? WHERE id=?");
        $stmt->execute([$musteri_id,$note,$id]);
        header("Location: iletisim_list.php");
        exit;
    } else { $hata = "Lütfen tüm alanları doldurun."; }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>İletişim Düzenle</title>
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'navbar_sidebar.php'; ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h2>İletişim Düzenle</h2>
        <?php if($hata) echo "<div class='alert alert-danger'>$hata</div>"; ?>
        <form method="POST">
          <select name="musteri_id" class="form-control mb-2">
            <option value="">Müşteri Seç</option>
            <?php foreach($musteriler as $m): ?>
              <option value="<?= $m['id'] ?>" <?= $m['id']==$iletisim['musteri_id']?'selected':'' ?>>
                <?= $m['ad'].' '.$m['soyad'] ?>
              </option>
            <?php endforeach; ?>
          </select>
          <textarea name="note" class="form-control mb-2"><?= $iletisim['note'] ?></textarea>
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
