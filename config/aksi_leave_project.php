<?php
include '../inc/connec.php';
session_start();

$id_user = $_SESSION['id_user'];
$id_project = $_POST['id_project'] ?? null;

if (!$id_user || !$id_project) {
  header("Location: ../?page=dashboard");
  exit;
}

// Cek role user
$qRole = mysqli_query($conn, "SELECT role FROM r_user_project WHERE id_user = '$id_user' AND id_project = '$id_project'");
$dataRole = mysqli_fetch_assoc($qRole);
$isAdmin = isset($dataRole['role']) && $dataRole['role'] === 'admin';

// Hitung total admin
$qAdmin = mysqli_query($conn, "SELECT COUNT(*) AS total_admin FROM r_user_project WHERE id_project = '$id_project' AND role = 'admin'");
$totalAdmin = mysqli_fetch_assoc($qAdmin)['total_admin'] ?? 0;

// Hitung total member
$qMember = mysqli_query($conn, "SELECT COUNT(*) AS total_member FROM r_user_project WHERE id_project = '$id_project'");
$totalMember = mysqli_fetch_assoc($qMember)['total_member'] ?? 0;

// ❌ Cegah keluar jika admin terakhir dan masih ada member lain
if ($isAdmin && $totalAdmin <= 1 && $totalMember > 1) {
  echo "<script>
    alert('⚠️ You are the only admin in this project.\\nPlease assign another admin before leaving.');
    window.history.back();
  </script>";
  exit;
}

// ✅ Hapus user dari project
mysqli_query($conn, "DELETE FROM r_user_project WHERE id_user = '$id_user' AND id_project = '$id_project'");

// Jika tidak ada user tersisa, hapus project dan data terkait
$qCheck = mysqli_query($conn, "SELECT COUNT(*) AS total FROM r_user_project WHERE id_project = '$id_project'");
$totalUser = mysqli_fetch_assoc($qCheck)['total'] ?? 0;

if ($totalUser == 0) {
  // Hapus notifikasi task
  $qTasks = mysqli_query($conn, "SELECT id_task FROM task WHERE id_project = '$id_project'");
  $taskIds = [];
  while ($row = mysqli_fetch_assoc($qTasks)) {
    $taskIds[] = $row['id_task'];
  }
  if (!empty($taskIds)) {
    $taskIdList = implode(",", array_map('intval', $taskIds));
    mysqli_query($conn, "DELETE FROM notification WHERE table_related = 'task' AND id_related IN ($taskIdList)");
  }

  // Hapus semua data terkait project
  mysqli_query($conn, "DELETE FROM task WHERE id_project = '$id_project'");
  mysqli_query($conn, "DELETE FROM notification WHERE table_related = 'project' AND id_related = '$id_project'");
  mysqli_query($conn, "DELETE FROM project WHERE id_project = '$id_project'");
}

// Redirect
header("Location: ../?page=dashboard");
exit;