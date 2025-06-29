<?php
include '../inc/connec.php';
session_start();

$id_task = $_POST['id_task'];
$id_project = $_POST['id_project'];
$id_user = $_POST['id_user'];
$id_actor = $_POST['id_actor'];
$now = date('Y-m-d H:i:s');

// Tambahkan ke r_user_task
$insertTask = "INSERT INTO r_user_task (id_user, id_task, status) VALUES ('$id_user', '$id_task', 'progress')";
mysqli_query($conn, $insertTask);

// Kirim notifikasi
$message = "You have been assigned to a new task.";
$insertNotif = "INSERT INTO notification 
  (id_user, id_actor, type, message, id_related, table_related, is_read, created_at)
  VALUES 
  ('$id_user', '$id_actor', 'assignment', '$message', '$id_task', 'task', 0, '$now')";
mysqli_query($conn, $insertNotif);

echo "<script>
  alert('Contributor assigned successfully.');
  window.location = '../?page=project&&id=$id_project';
</script>";
?>