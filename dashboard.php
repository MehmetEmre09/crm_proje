<?php
include 'navbar_sidebar.php';
include 'db.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Toplam Müşteri -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) as total FROM customers");
                                $row = $stmt->fetch();
                                $totalCustomers = $row['total'];
                                ?>
                                <h3><?= $totalCustomers ?></h3>
                                <p>Toplam Müşteri</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Aktif Fırsatlar -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) as total FROM opportunities WHERE status='aktif'");
                                $row = $stmt->fetch();
                                $activeOpportunities = $row['total'];
                                ?>
                                <h3><?= $activeOpportunities ?></h3>
                                <p>Aktif Fırsatlar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Son Görüşmeler -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) as total FROM communications WHERE DATE(created_at) = CURDATE()");
                                $row = $stmt->fetch();
                                $todayCommunications = $row['total'];
                                ?>
                                <h3><?= $todayCommunications ?></h3>
                                <p>Bugünkü Görüşmeler</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-comments"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Yeni Eklenen Fırsatlar -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) as total FROM opportunities WHERE DATE(created_at) = CURDATE()");
                                $row = $stmt->fetch();
                                $newOpportunities = $row['total'];
                                ?>
                                <h3><?= $newOpportunities ?></h3>
                                <p>Yeni Fırsatlar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- İleriye dönük diğer içerikler -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Son 5 Görüşme</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Müşteri</th>
                                            <th>Not</th>
                                            <th>Tarih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $pdo->query("SELECT c.name, com.note, com.created_at FROM communications com JOIN customers c ON com.customer_id=c.id ORDER BY com.created_at DESC LIMIT 5");
                                        while($row = $stmt->fetch()) {
                                            echo "<tr>
                                                    <td>{$row['name']}</td>
                                                    <td>{$row['note']}</td>
                                                    <td>{$row['created_at']}</td>
                                                  </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<script src="js/adminlte.min.js"></script>
</body>
</html>
