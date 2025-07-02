<?php
include '../inc/connec.php';
session_start();

// Validasi parameter dari URL
if (!isset($_GET['id_task'], $_GET['action'])) {
  header("Location: ../index.php");
  exit;
}

$id_task = intval($_GET['id_task']); // pastikan angka
$action = $_GET['action'];

// Cek apakah task ada
$qTask = mysqli_query($conn, "SELECT * FROM task WHERE id_task = '$id_task'");
if (mysqli_num_rows($qTask) === 0) {
  header("Location: ../?page=mailbox&error=notfound");
  exit;
}

if ($action === 'accept') {
  // Ubah status task menjadi 'progress'
  mysqli_query($conn, "UPDATE task SET status_task = 'progress' WHERE id_task = '$id_task'");
} elseif ($action === 'decline') {
  // Hapus task dari database
  mysqli_query($conn, "DELETE FROM task WHERE id_task = '$id_task'");
}

// Redirect kembali ke halaman notifikasi atau mailbox
header("Location: ../?page=mailbox");
exit;
?>