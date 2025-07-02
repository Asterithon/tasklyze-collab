<?php
include("../inc/connec.php");
session_start();

$id_task = $_POST['id_task'];
$id_project = $_GET['id'];
$id_actor = $_SESSION['id_user'];

// Ambil nama task sebelum dihapus
$taskQuery = mysqli_query($conn, "SELECT t.name_task, p.name_project
FROM task t
JOIN project p ON t.id_project = p.id_project
WHERE t.id_task = '$id_task'");
$taskData = mysqli_fetch_assoc($taskQuery);
$task_name = $taskData['name_task'] ?? 'Unknown Task';
$task_name = $taskData['name_project'] ?? 'Unknown Project';


// Ambil semua user yang sedang mengerjakan task ini
$assignedQuery = mysqli_query($conn, "
  SELECT id_user FROM r_user_task 
  WHERE id_task = '$id_task' AND id_user != '$id_actor'
");

// Hapus task
$sql = "DELETE FROM task WHERE id_task = '$id_task'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Kirim notifikasi ke semua user yang sedang mengerjakan task ini
    $message = "The task <strong>$task_name</strong> you were working on has been deleted.<br>Project: <em>$project_name</em>";

    while ($row = mysqli_fetch_assoc($assignedQuery)) {
        $id_user = $row['id_user'];
        $notif = "INSERT INTO notification 
            (id_user, id_actor, type, message, id_related, table_related, is_read)
            VALUES 
            ('$id_user', '$id_actor', 'task update', '$message', '$id_project', 'project', 0)";
        mysqli_query($conn, $notif);
    }

    echo "<script>window.location = '../?page=project&&id=$id_project';</script>";
} else {
    echo "<script>alert('Task failed to delete'); window.location = '../?page=project&&id=$id_project';</script>";
}
?>