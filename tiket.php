<?php
session_start();
include 'db.php';

// Cek dari parameter atau session
$id = $_GET['id'] ?? ($_SESSION['tiket_id'] ?? null);

if (!$id) {
    die("Tiket tidak ditemukan. Silakan daftar ulang.");
}

$query = $conn->query("SELECT * FROM pendaftaran WHERE id = $id");
if ($query->num_rows == 0) {
    die("Data tidak ditemukan.");
}

$data = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tiket Antrian</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 p-10">
  <div class="bg-white p-6 rounded-xl shadow-md max-w-xl mx-auto">
    <h1 class="text-green-600 text-xl font-bold text-center mb-2">Tiket Berhasil Dibuat!</h1>
    <p class="text-center text-gray-500">Silakan simpan nomor antrian Anda</p>

    <div class="border border-green-200 bg-green-50 mt-4 rounded-lg p-4 text-center">
      <p class="text-sm text-gray-500">Nomor Antrian</p>
      <p class="text-3xl font-bold text-blue-600"><?= $data['nomor_antrian'] ?></p>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4 text-sm">
      <div><strong>Nama Pasien:</strong><br><?= htmlspecialchars($data['nama']) ?></div>
      <div><strong>Tanggal & Waktu:</strong><br><?= date("l, d F Y", strtotime($data['tanggal'])) ?> <br><?= date("H:i") ?></div>
    </div>

    <div class="bg-blue-100 text-blue-800 mt-4 p-3 rounded text-sm">
      <strong>Status Antrian:</strong> <?= $data['status'] ?><br>
      <span class="text-xs">Perkiraan panggilan: <?= date("H:i", strtotime("+15 minutes")) ?></span>
    </div>

    <div class="bg-gray-100 mt-3 p-3 rounded text-sm">
      <strong>Lokasi Pelayanan:</strong><br>
      <?= htmlspecialchars($data['lokasi']) ?> – Lantai 2, Gedung Utama<br>
      Jl. Abiasa No. 111, Tangerang Selatan
    </div>

    <div class="mt-4 flex justify-center gap-4">
      <a href="pantau.php?id=<?= $data['id'] ?>" class="bg-blue-600 text-white px-4 py-2 rounded">Pantau Status</a>
      <a href="status_antrian.php" class="bg-gray-300 text-black px-4 py-2 rounded">Kembali ke Beranda</a>
      <button onclick="window.print()" class="bg-gray-300 text-black px-4 py-2 rounded">Cetak</button>
    </div>
  </div>
</body>
</html>
