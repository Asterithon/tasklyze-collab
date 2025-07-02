<?php
include '../inc/connec.php';
session_start();

if (!isset($_SESSION['id_user']) || !isset($_GET['id'])) {
  header("Location: ../index.php");
  exit;
}

$id_user = $_SESSION['id_user'];
$id_project = $_GET['id'];
$title = mysqli_real_escape_string($conn, $_POST['taskTitle']);
$desc = mysqli_real_escape_string($conn, $_POST['taskDescription']);
$status = $_POST['status']; 
$qUser = mysqli_query($conn, "SELECT username FROM user WHERE id_user = '$id_user'");
$userData = mysqli_fetch_assoc($qUser);
$username = $userData['username'] ?? 'Unknown User';

// Insert task
$insertTask = mysqli_query($conn, "
  INSERT INTO task (id_project, name_task, desc_task, status_task)
  VALUES ('$id_project', '$title', '$desc', '$status')
");

if (!$insertTask) {
  echo "Failed to create task: " . mysqli_error($conn);
  exit;
}

$id_task = mysqli_insert_id($conn); // Get the newly created task ID

// If task is a request, notify all admins
if ($status === 'request') {
  // Get project name
  $qProject = mysqli_query($conn, "SELECT name_project FROM project WHERE id_project = '$id_project'");
  $projectData = mysqli_fetch_assoc($qProject);
  $projectName = $projectData['name_project'] ?? 'Unknown Project';

  // Get all admins of the project
  $qAdmins = mysqli_query($conn, "
    SELECT id_user FROM r_user_project 
    WHERE id_project = '$id_project' AND role = 'admin'
  ");

  // Format notification message
  $message = "New task request: <strong>$title</strong><br>
              <em>$desc</em><br>
              in project <strong>$projectName</strong><br>
              ~ $username";

  while ($admin = mysqli_fetch_assoc($qAdmins)) {
    $adminId = $admin['id_user'];
    mysqli_query($conn, "
      INSERT INTO notification (id_user, message, type, table_related, id_related, is_read)
      VALUES ('$adminId', '$message', 'task', 'task', '$id_task', 0)
    ");
  }
}

// Redirect back to project page
header("Location: ../?page=project&id=$id_project");
exit;
?>