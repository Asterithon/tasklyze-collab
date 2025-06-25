<?php
include '../inc/connec.php';
session_start();
// Ambil data dari form
$project_name = $_POST["projectName"];
$project_desc = $_POST["projectDesc"];
$id_user = $_SESSION["id_user"];

// Mulai transaksi
mysqli_begin_transaction($conn);

try {
    // Insert project
    $sql1 = "INSERT INTO `project`(`name_project`, `desc_project`) VALUES ('$project_name','$project_desc')";
    mysqli_query($conn, $sql1);

    $newProjectID = mysqli_insert_id($conn); // Ambil ID project baru

    // Insert ke relasi user dengan project
    $sql2 = "INSERT INTO `r_user_project`(`id_user`, `id_project`, `role`) 
             VALUES ('$id_user', '$newProjectID', 'admin')";
    mysqli_query($conn, $sql2);

    mysqli_commit($conn);

    echo "<script>
        window.location = '../';
    </script>";
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "<script>

    </script>";
}
?>