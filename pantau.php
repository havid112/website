<?php
include 'db.php';

$id = $_GET['id'] ?? 0;
$query = $conn->query("SELECT * FROM pendaftaran WHERE id = $id");

if ($query->num_rows == 0) {
    die("Nomor antrian tidak ditemukan.");
}

$data = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Status Antrian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta http-equiv="refresh" content="15"> <!-- auto refresh tiap 15 detik -->
</head>
<body class="bg-blue-50 p-6">
  <div class="max-w-md mx-auto bg-white shadow-md p-6 rounded-xl">
    <h1 class="text-xl font-bold text-blue-700 mb-2 text-center">Status Antrian Anda</h1>

    <div class="text-center">
      <p class="text-sm text-gray-500">Nomor Antrian</p>
      <p class="text-3xl font-bold text-blue-600"><?= $data['nomor_antrian'] ?></p>
    </div>

    <div class="mt-4 text-center">
      <p class="text-sm text-gray-700">Nama Pasien: <strong><?= htmlspecialchars($data['nama']) ?></strong></p>
      <p class="text-sm text-gray-700">Lokasi: <?= $data['lokasi'] ?></p>
    </div>

    <div class="mt-6 p-4 rounded-lg
      <?= $data['status'] == 'Dipanggil' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
      <strong>Status Antrian:</strong><br>
      <?= $data['status'] == 'Dipanggil' ? 'Sudah Dipanggil' : 'Masih Menunggu' ?>
    </div>

    <?php if ($data['status'] == 'Menunggu'): ?>
    <p class="mt-4 text-sm text-center text-gray-600 italic">Harap tunggu. Halaman ini akan otomatis memperbarui.</p>
    <?php else: ?>
    <p class="mt-4 text-sm text-center text-green-600 font-semibold">Silakan menuju ruang pelayanan.</p>
    <?php endif; ?>
    <div class="mt-4 flex justify-center gap-4">
      <a href="tiket.php" class="bg-blue-500 text-black px-4 py-2 rounded">Kembali Ke Tiket </a>
    </div>
  </div>

</body>
</html>
