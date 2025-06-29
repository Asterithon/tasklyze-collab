<?php
include '../inc/connec.php';
session_start();

$id_user = $_SESSION['id_user'];
$id_notif = $_GET['id'] ?? null;

if ($id_notif) {
  // Tandai notifikasi sebagai dibaca
  mysqli_query($conn, "UPDATE notification SET is_read = 1 WHERE id = '$id_notif' AND id_user = '$id_user'");

  // Hitung ulang jumlah yang sudah dibaca
  $q = mysqli_query($conn, "SELECT COUNT(*) AS total_read FROM notification WHERE id_user = '$id_user' AND is_read = 0");
  $data = mysqli_fetch_assoc($q);
  echo $data['total_read'];
}
?>