<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nomor = $conn->real_escape_string($_POST['nomor_antrian']);
  $result = $conn->query("SELECT id FROM pendaftaran WHERE nomor_antrian = '$nomor' LIMIT 1");

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    header("Location: tiket.php?id=" . $row['id']);
    exit;
  } else {
    $error = "Nomor antrian tidak ditemukan.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cek Tiket Pasien</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-sky-100 to-blue-100 min-h-screen flex items-center justify-center px-4">
  <div class="bg-white max-w-md w-full p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-bold text-center text-blue-700 mb-4">🔍 Cek Tiket Antrian</h2>
    <form method="POST" class="space-y-4">
      <input type="text" name="nomor_antrian" placeholder="Masukkan Nomor Antrian Anda" required
        class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      
      <?php if (!empty($error)): ?>
        <p class="text-sm text-red-600"><?= $error ?></p>
      <?php endif; ?>

      <div class="text-right">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
          Lihat Tiket
        </button>
      </div>
    </form>
  </div>
</body>
</html>
