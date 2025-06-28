<?php
include '../inc/connec.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['invite_users'])) {
    $id_sender = $_SESSION['id_user'];
    $name_sender = $_SESSION['username'];
    $id_project = $_GET['id'];
$nama_project = 'Unknown';
$query = mysqli_query($conn, "SELECT name_project FROM project WHERE id_project = '$id_project'");
if ($data = mysqli_fetch_assoc($query)) {
    $nama_project = $data['name_project'];

    foreach ($_POST['invite_users'] as $id_receiver) {
        // Simpan ke invitation
        $desc = "Anda diundang untuk bergabung dalam project.";
        $status = "pending";

        $sql1 = "INSERT INTO invitation (id_sender, id_receiver, id_project, description, status)
                 VALUES ('$id_sender', '$id_receiver', '$id_project', '$desc', '$status')";
        mysqli_query($conn, $sql1);

        $invitation_id = mysqli_insert_id($conn);

        // Simpan notifikasi
        $message = "Ayo bergabung ke project : $nama_project. ~ $name_sender";
        $sql2 = "INSERT INTO notification (id_user, id_actor, type, message, id_related, table_related, is_read)
                 VALUES ('$id_receiver', '$id_sender', 'invitation', '$message', '$invitation_id', 'invitation', 0)";
        mysqli_query($conn, $sql2);
    }

    echo "<script>
        window.location = '../?page=project&&id=$id_project'; // atau arahkan ke halaman project
    </script>";
} else {
    echo "<script>
        alert('Tidak ada user yang dipilih untuk diundang.');
        window.location = '../';
    </script>";
}}
?>