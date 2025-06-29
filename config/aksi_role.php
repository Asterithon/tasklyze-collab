<?php
include '../inc/connec.php';
session_start();

$id_user = $_POST['id_user'];
$id_project = $_POST['id_project'];
$action = $_POST['action'];
$id_actor = $_SESSION['id_user'];

// Ambil nama project
$projectQuery = mysqli_query($conn, "SELECT name_project FROM project WHERE id_project = '$id_project'");
$projectData = mysqli_fetch_assoc($projectQuery);
$project_name = $projectData['name_project'] ?? 'Unknown Project';

if ($action === 'update') {
    $new_role = $_POST['new_role'];
    $update = "UPDATE r_user_project SET role = '$new_role' WHERE id_user = '$id_user' AND id_project = '$id_project'";
    mysqli_query($conn, $update);

} elseif ($action === 'kick') {
    // Hapus dari r_user_project
    $delete = "DELETE FROM r_user_project WHERE id_user = '$id_user' AND id_project = '$id_project'";
    mysqli_query($conn, $delete);

    // Hapus juga dari r_user_task
    $deleteTasks = "DELETE FROM r_user_task WHERE id_user = '$id_user' AND id_task IN (
        SELECT id_task FROM task WHERE id_project = '$id_project'
    )";
    mysqli_query($conn, $deleteTasks);

    // Notifikasi pengeluaran dari project (tanpa menyebut actor)
    $message = "You have been removed from the project <strong>$project_name</strong>.";
    $notif = "INSERT INTO notification 
        (id_user, id_actor, type, message, id_related, table_related, is_read)
        VALUES 
        ('$id_user', '$id_actor', 'project', '$message', '$id_project', 'project', 0)";
    mysqli_query($conn, $notif);
}

echo "<script>window.location = '../?page=project&&id=$id_project';</script>";
?>