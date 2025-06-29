<?php
session_start();
include 'db.php';

$lokasi     = $_POST['lokasi'];
$nama       = $_POST['nama'];
$email      = $_POST['email'];
$tanggal    = $_POST['tanggal'];
$permintaan = $_POST['permintaan'];
$setuju     = isset($_POST['setuju']) ? 1 : 0;
$tidak_setuju = isset($_POST['tidak_setuju']) ? 1 : 0;

// Buat nomor antrian: K + tanggal + random 4 digit
$tanggalKode = date("Ymd");
$nomor_antrian = "K" . $tanggalKode . rand(1000, 9999);

// Query insert
$sql = "INSERT INTO pendaftaran (lokasi, nama, email, tanggal, permintaan, setuju, tidak_setuju, status, nomor_antrian)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'Menunggu', ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssiis", $lokasi, $nama, $email, $tanggal, $permintaan, $setuju, $tidak_setuju, $nomor_antrian);

if ($stmt->execute()) {
    $id = $stmt->insert_id;
    $_SESSION['tiket_id'] = $id;

    // Redirect ke status antrian sesuai sistem kamu
    header("Location: status_antrian.php?id=$id");
    exit;
} else {
    echo "Gagal mendaftar: " . $conn->error;
}
?>
