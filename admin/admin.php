<?php
// Cek status session sebelum memulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect jika pengguna belum login
if (empty($_SESSION['id_petugas'])) {
    echo "<script>
        alert('Maaf, Anda belum login.');
        window.location.assign('../index2.php');
    </script>";
    exit;
}

// Redirect jika level bukan admin
if ($_SESSION['level'] != 'admin') {
    echo "<script>
        alert('Maaf, Anda bukan sesi admin.');
        window.location.assign('../index2.php');
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Aplikasi Pembayaran SPP</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="admin.php" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a onclick="return confirm('Apakah Anda yakin ingin logout?')" href="logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <i class="fas fa-user-circle brand-image img-circle elevation-3" style="font-size: 2.5rem; color: white;"></i>
                <span class="brand-text font-weight-light">
                    <?= htmlspecialchars($_SESSION['level'] === 'admin' ? 'Admin' : 'Petugas'); ?>
                </span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="admin.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin.php?url=spp" class="nav-link">
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>SPP</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin.php?url=kelas" class="nav-link">
                                <i class="nav-icon fas fa-school"></i>
                                <p>Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin.php?url=siswa" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin.php?url=petugas" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Petugas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin.php?url=pembayaran" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin.php?url=laporan" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <?php
                            $pageTitles = [
                                "" => "Dashboard",
                                "spp" => "SPP",
                                "kelas" => "Kelas",
                                "siswa" => "Siswa",
                                "petugas" => "Petugas",
                                "pembayaran" => "Pembayaran",
                                "laporan" => "Laporan"
                            ];
                            $currentUrl = @$_GET['url'] ?? "";
                            $title = $pageTitles[$currentUrl] ?? "Dashboard";
                            ?>
                            <h1 class="m-0"><?= htmlspecialchars($title); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <?php
                    $file = @$_GET['url'];
                    if (empty($file)) {
                        echo "<div class='alert alert-info'>Selamat Datang di Halaman Administrator Aplikasi Pembayaran SPP</div>";
                        echo "<p>Aplikasi ini digunakan untuk mempermudah mencatat pembayaran siswa/siswi di sekolah.</p>";
                    } else {
                        include $file . '.php';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date("Y"); ?> <a href="#">SPP System</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
