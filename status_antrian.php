<?php
include 'db.php';
session_start();

$id = $_GET['id'] ?? ($_SESSION['tiket_id'] ?? null);
if (!$id) die("Tiket tidak ditemukan.");

$query = $conn->query("SELECT * FROM pendaftaran WHERE id = $id");
if ($query->num_rows == 0) die("Tiket tidak ditemukan.");
$data = $query->fetch_assoc();

// Estimasi tunggu = hitung jumlah pasien 'Menunggu' sebelum pasien ini
$antrian = $conn->query("SELECT COUNT(*) as jumlah FROM pendaftaran WHERE status='Menunggu' AND id < $id");
$estimasi = $antrian->fetch_assoc()['jumlah'] * 5; // 5 menit per pasien

function statusBadge($status) {
  switch ($status) {
    case 'Dipanggil':
      return '<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">Dipanggil</span>';
    case 'Menunggu':
      return '<span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">Menunggu</span>';
    default:
      return '<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-medium">Tidak Aktif</span>';
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Status Antrian Digital</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <meta http-equiv="refresh" content="15"> <!-- Auto refresh tiap 15 detik -->
</head>
<body class="bg-sky-50 font-sans">

<!-- HEADER NAMA RUMAH SAKIT -->
  <div class="bg-blue-800 text-white py-4 shadow-md">
    <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
      <div class="text-lg md:text-xl font-bold tracking-wide">
        🏥 Rumah Sakit Pamulang
      </div>
      <div class="text-sm hidden md:block">
        <a href="index.php" class="bg-red-500 text-white px-4 py-2 rounded">Kembali ke Pendaftaran</a>
      </div>
    </div>
  </div>

  <div class="max-w-4xl mx-auto px-4 py-8">

    <header class="mb-6">
      <h1 class="text-3xl font-bold text-blue-800">📊 Status Antrian Real-time</h1>
      <div class="flex justify-between items-center mt-8 text-sm text-gray-500">
        <a href="status_antrian.php?id=<?= $data['id'] ?>" class="ml-auto class="px-3 py-1 border rounded bg-white hover:bg-blue-100" >🔄 Refresh</a>
      </div>
      <p class="text-gray-600">Pantau perkembangan antrian Anda secara langsung.</p>
    </header>

    <!-- Tiket Aktif -->
    <section class="bg-white p-6 rounded-xl shadow mb-6 border border-blue-200">
      <div class="flex justify-between items-center mb-2">
        <h2 class="text-xl font-semibold text-blue-700">👁️ Tiket Aktif</h2>
        <?= statusBadge($data['status']) ?>
      </div>

      <div class="mt-2 space-y-1">
        <p class="text-gray-700"><strong>Nomor Antrian:</strong> <span class="text-blue-800 text-xl font-bold"><?= $data['nomor_antrian'] ?></span></p>
        <p class="text-gray-700"><strong>Poliklinik:</strong> <?= htmlspecialchars($data['lokasi']) ?></p>
        <p class="text-gray-700"><strong>Perkiraan Panggilan:</strong> <?= date("H:i", strtotime("+$estimasi minutes")) ?> (±<?= $estimasi ?> menit)</p>
      </div>

      <div class="mt-4 text-right">
        <a href="tiket.php?id=<?= $data['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">Lihat Detail</a>
      </div>
    </section>

    <!-- Riwayat Tiket -->
    <section class="bg-white p-6 rounded-xl shadow border">
      <h2 class="text-xl font-semibold text-gray-800 mb-3">📁 Riwayat Tiket Anda</h2>

      <div class="bg-gray-50 p-4 rounded-md border">
        <div class="flex justify-between items-center">
          <div>
            <p class="font-semibold text-blue-700"><?= $data['nomor_antrian'] ?></p>
            <p class="text-sm text-gray-500"><?= htmlspecialchars($data['lokasi']) ?></p>
          </div>
          <div class="text-right text-sm text-gray-500">
            <p>📅 <?= date("d/m/Y", strtotime($data['tanggal'])) ?></p>
            <p>⏰ <?= date("H:i", strtotime($data['created_at'])) ?></p>
          </div>
        </div>
        <div class="mt-2">
          <?= statusBadge($data['status']) ?>
        </div>
      </div>
    </section>

    <div class="flex justify-between items-center mt-8 text-sm text-gray-500">
      <p>🕓 Terakhir diperbarui: <?= date("H:i:s") ?></p>
    </div>

  </div>

  <footer class="bg-blue-900 text-white text-center py-4 mt-10">
    Rumah Sakit Pamulang &middot; Sistem Antrian Digital
  </footer>
</body>
</html>
