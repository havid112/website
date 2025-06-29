<?php
include 'db.php';

$result = $conn->query("SELECT * FROM pendaftaran WHERE status = 'Menunggu' ORDER BY created_at ASC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Monitor Antrian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta http-equiv="refresh" content="10">
</head>
<body class="bg-white text-center p-10">
  <h1 class="text-3xl font-bold mb-6">Pasien Menunggu</h1>
  <ul class="space-y-4 text-lg">
    <?php while ($row = $result->fetch_assoc()): ?>
      <li><?= htmlspecialchars($row['nama']) ?> - <?= $row['lokasi'] ?></li>
    <?php endwhile; ?>
  </ul>
</body>
</html>
