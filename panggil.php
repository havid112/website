<?php
include 'db.php';

if (!isset($_POST['id'])) {
    die("ID pasien tidak ditemukan.");
}

$id = intval($_POST['id']); // amankan input

$query = "UPDATE pendaftaran SET status = 'Dipanggil' WHERE id = $id";

if ($conn->query($query)) {
    header("Location: admin.php");
    exit;
} else {
    echo "Gagal memanggil pasien: " . $conn->error;
}
?>
