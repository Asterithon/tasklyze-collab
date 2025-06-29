<?php
include '../inc/connec.php';
session_start();

$id_task = $_POST['id_task'];
$id_project = $_POST['id_project'];
$id_user = $_POST['id_user'];
$id_actor = $_POST['id_actor'];

// Ambil nama task dan nama project
$query = "
  SELECT t.name_task, p.name_project 
  FROM task t
  JOIN project p ON t.id_project = p.id_project
  WHERE t.id_task = '$id_task'
";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$task_name = $data['name_task'];
$project_name = $data['name_project'];

// Tambahkan ke r_user_task
$insertTask = "INSERT INTO r_user_task (id_user, id_task, status) VALUES ('$id_user', '$id_task', 'progress')";
mysqli_query($conn, $insertTask);

// Kirim notifikasi
$message = "You have been assigned to a task: <strong>$task_name</strong><br>Project: <em>$project_name</em>";
$insertNotif = "INSERT INTO notification 
  (id_user, id_actor, type, message, id_related, table_related, is_read) 
  VALUES 
  ('$id_user', '$id_actor', 'reminder', '$message', '$id_task', 'task', 0)";
mysqli_query($conn, $insertNotif);

// Redirect
echo "<script>
  window.location = '../?page=project&&id=$id_project';
</script>";
?>