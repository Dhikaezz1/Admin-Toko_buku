<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator - Aplikasi Pembayaran SPP</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Ikon Bootstrap -->
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

        .input-group-text {
            cursor: pointer; /* Menjadikan ikon sebagai tombol */
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <img src="logo-spp.png" width="100%">
        </div>
        <div class="card-body">
            <h4 class="text-center mb-4">Login Administrator</h4>
            <form action="proses-login-petugas.php" method="post">
                <div class="form-group mb-4">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username Anda" required>
                </div>
                <div class="form-group mb-4">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Anda" required>
                        <span class="input-group-text" id="toggle-password">
                            <i class="bi bi-eye-slash" id="eye-icon"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
                <a href="index.php" class="text-center d-block">Login Sebagai Siswa</a>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript untuk toggle password visibility
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        togglePassword.addEventListener('click', () => {
            // Ubah tipe input password
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Ganti ikon
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>
