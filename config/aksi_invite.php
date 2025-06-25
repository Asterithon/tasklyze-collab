<?php
include '../inc/connec.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['invite_users'])) {
    $id_sender = $_SESSION['id_user'];
    $id_project = $_GET['id'];
    $now = date('Y-m-d H:i:s');

    foreach ($_POST['invite_users'] as $id_receiver) {
        // Simpan ke invitation
        $desc = "Anda diundang untuk bergabung dalam project.";
        $status = "pending";

        $sql1 = "INSERT INTO invitation (id_sender, id_receiver, id_project, description, status, created_at)
                 VALUES ('$id_sender', '$id_receiver', '$id_project', '$desc', '$status', '$now')";
        mysqli_query($conn, $sql1);

        $invitation_id = mysqli_insert_id($conn);

        // Simpan notifikasi
        $message = "Anda mendapat undangan untuk bergabung ke project.";
        $sql2 = "INSERT INTO notification (id_user, id_actor, type, message, id_related, table_related, is_read, created_at)
                 VALUES ('$id_receiver', '$id_sender', 'invitation', '$message', '$invitation_id', 'invitation', 0, '$now')";
        mysqli_query($conn, $sql2);
    }

    echo "<script>
        alert('Undangan berhasil dikirim!');
        window.location = '../'; // atau arahkan ke halaman project
    </script>";
} else {
    echo "<script>
        alert('Tidak ada user yang dipilih untuk diundang.');
        window.location = '../';
    </script>";
}
?>