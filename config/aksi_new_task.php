<?php
    include ("../inc/connec.php");
    $title = $_POST["taskTitle"];
    $description = $_POST["taskDescription"];
    $id_project = $_GET['id'];

    $sql = "INSERT INTO task (name_task, desc_task, status_task, id_project) VALUES ('$title', '$description', 'progress', '$id_project')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Task succesfully created');
        window.location = '../?page=project&&id=$id_project';</script>";
    } else {
    echo "<script>alert('Task Failed to create');
        window.location = '../?page=project&&id=$id_project';</script>";
    }
?>