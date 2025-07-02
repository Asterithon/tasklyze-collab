<?php
include '../inc/connec.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_invitation = $_GET['id_invitation'];
    $action = $_GET['action']; // 'accepted' atau 'declined'
    $now = date('Y-m-d H:i:s');
    if (in_array($action, ['accepted', 'declined'])) {
        // Update status invitation
        $update = "UPDATE invitation SET status = '$action', created_at = '$now' WHERE id = '$id_invitation'";
        mysqli_query($conn, $update);

        // Jika accepted, masukkan ke r_user_project
        if ($action === 'accepted') {
            // Ambil data undangan untuk mendapatkan id_user dan id_project
            $getInvite = mysqli_query($conn, "SELECT id_receiver, id_project FROM invitation WHERE id = '$id_invitation'");
            $inviteData = mysqli_fetch_assoc($getInvite);

            $id_user = $inviteData['id_receiver'];
            $id_project = $inviteData['id_project'];

            // Masukkan user ke tabel project
            $insert = "INSERT INTO r_user_project (id_user, id_project, role) VALUES ('$id_user', '$id_project', 'member')";
            mysqli_query($conn, $insert);
                echo "<script>
        window.location = '../?page=project&&id=$id_project';
    </script>";
        } else{
                echo "<script>
        window.location = '../?page=mailbox';
    </script>";
        }
    }

    echo "<script>
        window.location = '../?page=project&&id=$id_project';;
    </script>";
}
?>