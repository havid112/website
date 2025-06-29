<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM pendaftaran WHERE id=$id");
header("Location: admin.php");
exit;
