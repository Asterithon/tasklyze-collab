<?php
include '../inc/connec.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_project = $_POST['id_project'];
    $name = mysqli_real_escape_string($conn, $_POST['projectName']);
    $desc = mysqli_real_escape_string($conn, $_POST['projectDescription']);
    $now = date('Y-m-d H:i:s');

    $sql = "UPDATE project 
            SET name_project = '$name', desc_project = '$desc', created_at = '$now' 
            WHERE id_project = '$id_project'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location = '../?page=project&&id=$id_project';</script>";
    } else {
        echo "<script>alert('Failed to update project.'); window.history.back();</script>";
    }
}
?>