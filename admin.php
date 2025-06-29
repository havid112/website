<?php
include 'db.php';
$result = $conn->query("SELECT * FROM pendaftaran ORDER BY tanggal ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Antrian Pasien</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-sky-100 min-h-screen p-6">
  <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-xl p-6">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">📋 Riwayat Antrian Pasien</h1>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-left border border-gray-200">
        <thead class="bg-blue-100 text-gray-700 font-semibold">
          <tr>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Lokasi</th>
            <th class="px-4 py-3">Tanggal</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-3"><?= htmlspecialchars($row['nama']) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars($row['email']) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars($row['lokasi']) ?></td>
            <td class="px-4 py-3"><?= date("d M Y", strtotime($row['tanggal'])) ?></td>
            <td class="px-4 py-3 text-center space-x-1">
  <?php if ($row['status'] == 'Menunggu'): ?>
    <form action="panggil.php" method="POST" class="inline">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">Panggil</button>
    </form>
  <?php endif; ?>

  <a href="edit.php?id=<?= $row['id'] ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded inline-block">Edit</a>
  <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded inline-block">Hapus</a>
  <a href="tambah.php" class="bg-green-600 hover:bg-green-500 text-white px-4 py-1 rounded-md">+ Tambah Pasien</a>
</td>

            <td class="px-4 py-3 text-center">
              <?php if ($row['status'] == 'Menunggu'): ?>
                <form action="panggil.php" method="POST">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded-md transition-all">Panggil</button>
                </form>
              <?php else: ?>
                <span class="text-gray-400 italic text-xs">Sudah dipanggil</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
