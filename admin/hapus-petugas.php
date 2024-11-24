<?php
$id_petugas = $_GET['id_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$nama_petugas = $_POST['nama_petugas'];
$level = $_POST['level'];

include '../koneksi.php';
$sql = "DELETE FROM petugas WHERE id_petugas='$id_petugas'";
$query = mysqli_query($koneksi, $sql);
if($query){
    header("Location:?url=petugas");
}else{
    echo "<script>alert('Maaf Data Tidak Terhapus'); window.location,assign('?url=petugas');</script>";
}
?>