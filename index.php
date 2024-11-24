<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Siswa - aplikasi pembayaran spp</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #007bff; /* Warna biru */
            color: white; /* Teks warna putih agar lebih kontras */
            height: 100vh; /* Tinggi layar penuh */
            display: flex; /* Menggunakan Flexbox */
            justify-content: center; /* Pusatkan secara horizontal */
            align-items: center; /* Pusatkan secara vertikal */
            margin: 0; /* Menghapus margin default */
        }

        .card {
            background-color: white; /* Latar belakang kartu tetap putih */
            color: black; /* Teks di dalam kartu tetap hitam */
            max-width: 420px; /* Batas lebar maksimum card */
            width: 100%; /* Lebar penuh untuk perangkat kecil */
            padding: 15px; /* Padding untuk estetika */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Sedikit bayangan */
            border-radius: 8px; /* Membuat sudut kartu lebih halus */
        }

        .card-header img {
            border-radius: 9px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <img src="logo-spp.png" width="100%">
        </div>
        <div class="card-body">
            <h4 class="text-center mb-4">LOGIN SISWA</h4>
            <form action="proses-login-siswa.php" method="post">
                <div class="form-group mb-4">
                    <label>NISN</label>
                    <input type="number" name="nisn" class="form-control" placeholder="Masukkan NISN Anda" required>
                </div>
                <div class="form-group mb-4">
                    <label>NIS</label>
                    <input type="number" name="nis" class="form-control" placeholder="Masukkan NIS Anda" required>
                </div>
                <div class="form-group mb-4">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
                <a href="index2.php" class="text-center d-block">Login Sebagai Administrator / Petugas</a>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
