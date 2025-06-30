<?php
include '../inc/connec.php';
session_start();
$id_user = $_SESSION['id_user'];
$action = $_POST['action'] ?? '';

if ($action === 'delete' && isset($_POST['selected_ids'])) {
  $ids = explode(',', $_POST['selected_ids']);
  $ids = array_map('intval', $ids);
  $idList = implode(',', $ids);

  // Cek invitation yang masih pending
  $invitationQuery = mysqli_query($conn, "
    SELECT id_related FROM notification 
    WHERE id_user = '$id_user' 
    AND id IN ($idList) 
    AND type = 'invitation'
    AND table_related = 'invitation'
  ");

  while ($row = mysqli_fetch_assoc($invitationQuery)) {
    $invId = $row['id_related'];
    $check = mysqli_query($conn, "SELECT status FROM invitation WHERE id = '$invId'");
    $data = mysqli_fetch_assoc($check);
    if ($data && $data['status'] === 'pending') {
      // Tandai sebagai declined
      mysqli_query($conn, "UPDATE invitation SET status = 'declined' WHERE id = '$invId'");
    }
  }

  // Hapus notifikasi
  mysqli_query($conn, "DELETE FROM notification WHERE id_user = '$id_user' AND id IN ($idList)");
}elseif ($action === 'read_all') {
  mysqli_query($conn, "UPDATE notification SET is_read = 1 WHERE id_user = '$id_user'");
}

header("Location: ../?page=mailbox");
exit;
?>