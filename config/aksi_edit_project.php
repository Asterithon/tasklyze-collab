<?php
include '../inc/connec.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_project = $_POST['id_project'];
    $name = mysqli_real_escape_string($conn, $_POST['projectName']);
    $desc = mysqli_real_escape_string($conn, $_POST['projectDescription']);
    $id_actor = $_SESSION['id_user'];

    $sql = "UPDATE project 
            SET name_project = '$name', desc_project = '$desc' 
            WHERE id_project = '$id_project'";

    if (mysqli_query($conn, $sql)) {
        // Ambil semua user dalam project kecuali yang mengedit
        $userQuery = mysqli_query($conn, "
            SELECT id_user FROM r_user_project 
            WHERE id_project = '$id_project' AND id_user != '$id_actor'
        ");

        // Siapkan pesan notifikasi
        $message = "Project <strong>$name</strong> has been updated.";

        while ($row = mysqli_fetch_assoc($userQuery)) {
            $id_user = $row['id_user'];
            $notif = "INSERT INTO notification 
                (id_user, id_actor, type, message, id_related, table_related, is_read)
                VALUES 
                ('$id_user', '$id_actor', 'project', '$message', '$id_project', 'project', 0)";
            mysqli_query($conn, $notif);
        }

        echo "<script>window.location = '../?page=project&&id=$id_project';</script>";
    } else {
        echo "<script>alert('Failed to update project.'); window.history.back();</script>";
    }
}
?>