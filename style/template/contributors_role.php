<?php



        // Cek apakah user yang login adalah admin di project ini
$isSelf = ($id_contributor == $id_user);
$isAdmin = false;
$checkAdmin = mysqli_query($conn, "SELECT role FROM r_user_project WHERE id_user = '$id_user' AND id_project = '$id_project'");
if ($checkAdmin && $adminRow = mysqli_fetch_assoc($checkAdmin)) {
    $isAdmin = ($adminRow['role'] === 'admin');
}
?>
<!-- Modal -->
<div class="modal fade" id="modalChangeRole<?php echo $id_contributor; ?>" aria-labelledby="modalChangeRoleLabel<?php echo $id_contributor; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form action="config/aksi_role.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Contributor Information</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <!-- Basic Info -->
          <p class="mb-1"><strong>Username:</strong> <?= $nama ?></p>
          <p class="mb-3 text-muted"><strong>Email:</strong> <?= $email ?></p>

          <!-- Task Summary -->
          <h6 class="mb-2">Task Summary</h6>
          <?php
          $taskQuery = "
            SELECT t.name_task, rut.status
            FROM task t
            JOIN r_user_task rut ON rut.id_task = t.id_task
            WHERE rut.id_user = '$id_contributor' AND t.id_project = '$id_project'
          ";
          $taskResult = mysqli_query($conn, $taskQuery);
          if (mysqli_num_rows($taskResult) > 0) {
              $completed = 0;
              $total = 0;
              while ($task = mysqli_fetch_assoc($taskResult)) {
                  $total++;
                  if (strtolower($task['status']) === 'done') {
                      $completed++;
                  }
              }
              echo "<p class='mb-0'>Completed Tasks: <strong>$completed</strong> of <strong>$total</strong></p>";
          } else {
              echo "<p class='text-muted'>This contributor has not been assigned to any tasks yet.</p>";
          }
          ?>

          <!-- Role Change -->
          <?php if ($isAdmin && !$isSelf): ?>
            <hr>
            <h6 class="mb-2">Change Role</h6>
            <input type="hidden" name="id_user" value="<?= $id_contributor ?>">
            <input type="hidden" name="id_project" value="<?= $id_project ?>">
            <div class="form-group mb-3">
              <select name="new_role" class="form-control">
                <option value="member" <?= $role === 'member' ? 'selected' : '' ?>>Member</option>
                <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
              </select>
            </div>
          <?php endif; ?>
        </div>

        <div class="modal-footer">


          <?php if ($isAdmin && !$isSelf): ?>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="action" value="kick" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to remove this user from the project?')">Kick User</button>
            <button type="submit" name="action" value="update" class="btn btn-primary">Save Changes</button>
          <?php endif; ?>
        </div>
      </form>

      <!-- Leave Project Form (terpisah) -->
      <?php if ($isSelf): 
// Cek apakah user adalah satu-satunya admin
$qAdminCount = mysqli_query($conn, "
  SELECT COUNT(*) AS total_admin 
  FROM r_user_project 
  WHERE id_project = '$id_project' AND role = 'admin'
");
 $qMemberCount = mysqli_query($conn, "
  SELECT COUNT(*) AS total_member 
  FROM r_user_project 
  WHERE id_project = '$id_project'
");
$dataMemberCount = mysqli_fetch_assoc($qMemberCount);
$totalMember = $dataMemberCount['total_member'] ?? 0; 
$dataAdminCount = mysqli_fetch_assoc($qAdminCount);
$totalAdmin = $dataAdminCount['total_admin'] ?? 0;
?>
        <div class="modal-footer border-top">
<form method="POST" action="config/aksi_leave_project.php" class="d-inline">
  <input type="hidden" name="id_project" value="<?= $id_project ?>">
  <button type="submit" name="action" value="leave" class="btn btn-outline-danger">
    Leave Project
  </button>
</form>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>

