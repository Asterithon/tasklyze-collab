<?php
include '../inc/connec.php';
session_start();
$id_project = $_POST['id_project'];
$id_task = $_POST['id_task'];
$id_user = $_POST['id_user'];
$action = $_POST['action'];

if ($action === 'assign') {
    $insert = "INSERT INTO r_user_task (id_user, id_task, status) VALUES ('$id_user', '$id_task', 'progress')";
    mysqli_query($conn, $insert);
} elseif ($action === 'leave') {
    $delete = "DELETE FROM r_user_task WHERE id_user = '$id_user' AND id_task = '$id_task'";
    mysqli_query($conn, $delete);
}
elseif ($action === 'mark_done') {
    $update = "UPDATE r_user_task SET status = 'done' WHERE id_user = '$id_user' AND id_task = '$id_task'";
    mysqli_query($conn, $update);
} elseif ($action === 'mark_progress') {
    $update = "UPDATE r_user_task SET status = 'progress' WHERE id_user = '$id_user' AND id_task = '$id_task'";
    mysqli_query($conn, $update);
}

echo "<script>window.location = '../?page=project&&id=$id_project';</script>";