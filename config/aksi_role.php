<?php
include '../inc/connec.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_user = $_POST['id_user'];
    $id_project = $_POST['id_project'];
    $new_role = $_POST['new_role'];

    $sql = "UPDATE r_user_project 
            SET role = '$new_role' 
            WHERE id_user = '$id_user' AND id_project = '$id_project'";
    mysqli_query($conn, $sql);

    echo "<script>
        
        window.location = '../?page=project&id=$id_project'; // arahkan ke halaman project
    </script>";
}
?>