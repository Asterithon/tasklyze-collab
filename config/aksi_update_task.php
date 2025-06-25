<?php
include("../inc/connec.php");
$title = $_POST["taskTitle"];
$description = $_POST["taskDescription"];
$id_task = $_POST['id_task'];
$id_project = $_GET['id'];

$sql = "UPDATE task SET name_task = '$title', desc_task = '$description' WHERE id_task = '$id_task'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Task succesfully Updated');
        window.location = '../?page=project&&id=$id_project';</script>";
} else {
    echo "<script>alert('Task Failed to create');
        window.location = '../?page=project&&id=$id_project';</script>";
}
?>