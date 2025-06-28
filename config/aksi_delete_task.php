<?php
include("../inc/connec.php");
$id_task = $_POST['id_task'];
$id_project = $_GET['id'];

$sql = "DELETE FROM task WHERE id_task = '$id_task'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "
        window.location = '../?page=project&&id=$id_project';</script>";
} else {
    echo "<script>alert('Task Failed to create');
        window.location = '../?page=project&&id=$id_project';</script>";
}
?>