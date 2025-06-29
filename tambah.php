<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $lokasi = $_POST['lokasi'];
  $tanggal = $_POST['tanggal'];
  $conn->query("INSERT INTO pendaftaran (nama, email, lokasi, tanggal, status) VALUES ('$nama','$email','$lokasi','$tanggal','Menunggu')");
  header("Location: admin.php");
  exit;
}
?>

<form method="POST" class="max-w-xl mx-auto p-6 bg-white mt-10 rounded shadow">
  <h2 class="text-xl font-bold mb-4">Tambah Data Pasien</h2>
  <input name="nama" required class="w-full border p-2 mb-2" placeholder="Nama">
  <input name="email" required class="w-full border p-2 mb-2" placeholder="Email">
  <input name="lokasi" required class="w-full border p-2 mb-2" placeholder="Lokasi">
  <input type="date" name="tanggal" required class="w-full border p-2 mb-4">
  <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Tambah</button>
</form>
