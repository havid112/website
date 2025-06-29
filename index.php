<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pendaftaran Pasien</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-sky-100 to-blue-100 min-h-screen flex items-center justify-center px-4">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl p-8">
    <h1 class="text-2xl md:text-3xl font-bold text-center text-blue-700 mb-6">🏥 Rumah Sakit Pamulang</h1><br>
    <h6 class="text-2xl md:text-3xl font-bold text-center text-blue-700 mb-6">📝 Form Pendaftaran Pasien</h6>

    <form action="submit.php" method="POST" class="space-y-6">
      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Lokasi Rumah Sakit<span class="text-red-500">*</span></label>
          <select name="lokasi" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">-- Pilih Lokasi --</option>
            <option value="RS Pamulang">RS Pamulang</option>
            <option value="RS Ciputat">RS Ciputat</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama (sesuai Paspor)<span class="text-red-500">*</span></label>
          <input type="text" name="nama" required placeholder="Nama lengkap" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email<span class="text-red-500">*</span></label>
          <input type="email" name="email" required placeholder="nama@email.com" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Janji Temu<span class="text-red-500">*</span></label>
          <input type="date" name="tanggal" required class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kekhawatiran / Permintaan Medis<span class="text-red-500">*</span></label>
        <textarea name="permintaan" required rows="4" placeholder="Tulis permintaan medis atau isi N/A" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
      </div>

      <div class="space-y-2 text-sm text-gray-700">
        <label class="flex items-center space-x-2">
          <input type="checkbox" name="setuju" value="1" required class="accent-blue-500">
          <span>Saya setuju untuk menerima pesan atau jaminan terkait pemasaran.</span>
        </label>
        <label class="flex items-center space-x-2">
          <input type="checkbox" name="tidak_setuju" value="1" class="accent-blue-500">
          <span>Saya tidak setuju untuk menerima pesan atau jaminan terkait pemasaran.</span>
        </label>
      </div>

      <p class="text-xs text-gray-500">
        Dengan ini saya menyetujui <a href="#" class="text-blue-600 underline">Pemberitahuan Perlindungan Data Pribadi</a> IHH MY.
      </p>

      <div class="flex justify-between mt-6">
  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition-all duration-200">
    Kirim Pendaftaran
  </button>
  <div class="text-center mt-6">
  <p class="text-sm text-gray-500">Sudah punya nomor antrian?</p>
  <a href="cek_tiket.php" class="text-blue-700 font-semibold underline">Cek Tiket Anda</a>
  </div>
  </div>
</body>
</html>
