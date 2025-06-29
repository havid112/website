<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM pendaftaran WHERE id=$id");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $lokasi = $_POST['lokasi'];
  $tanggal = $_POST['tanggal'];
  $status = $_POST['status'];

  $conn->query("UPDATE pendaftaran SET nama='$nama', email='$email', lokasi='$lokasi', tanggal='$tanggal', status='$status' WHERE id=$id");
  header("Location: admin.php");
  exit;
}
?>

<form method="POST" class="max-w-xl mx-auto p-6 bg-white mt-10 rounded shadow">
  <h2 class="text-xl font-bold mb-4">Edit Data Pasien</h2>
  <input name="nama" value="<?= $data['nama'] ?>" required class="w-full border p-2 mb-2" placeholder="Nama">
  <input name="email" value="<?= $data['email'] ?>" required class="w-full border p-2 mb-2" placeholder="Email">
  <input name="lokasi" value="<?= $data['lokasi'] ?>" required class="w-full border p-2 mb-2" placeholder="Lokasi">
  <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required class="w-full border p-2 mb-2">
  <select name="status" class="w-full border p-2 mb-4">
    <option value="Menunggu" <?= $data['status'] == 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
    <option value="Dipanggil" <?= $data['status'] == 'Dipanggil' ? 'selected' : '' ?>>Dipanggil</option>
  </select>
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
</form>
