<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Proje</title>
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <span class="navbar-text">CRM Proje</span>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">CRM</a>
    <div class="sidebar">
      <nav>
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-item"><a href="musteri_list.php" class="nav-link">Müşteriler</a></li>
          <li class="nav-item"><a href="satis_list.php" class="nav-link">Satışlar</a></li>
          <li class="nav-item"><a href="iletisim_list.php" class="nav-link">İletişim</a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <h1>Hoşgeldiniz</h1>
        <p>AdminLTE ile hazırlanmış CRM projesi.</p>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <strong>CRM Proje</strong>
  </footer>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
