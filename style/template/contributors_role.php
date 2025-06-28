<?php
// Cek apakah user yang login adalah admin di project ini
$isAdmin = false;
$checkAdmin = mysqli_query($conn, "SELECT role FROM r_user_project WHERE id_user = '$id_user' AND id_project = '$id_project'");
if ($checkAdmin && $adminRow = mysqli_fetch_assoc($checkAdmin)) {
    $isAdmin = ($adminRow['role'] === 'admin');
}
?>
<!-- modal_change_role.php -->
<div class="modal fade" id="modalChangeRole<?php echo $id_contributor; ?>" aria-labelledby="modalChangeRoleLabel<?php echo $id_contributor; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="config/aksi_role.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Contributor Information</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <!-- Basic Info -->
          <p class="mb-1"><strong>Username:</strong> <?php echo $nama; ?></p>
          <p class="mb-3 text-muted"><strong>Email:</strong> <?php echo $email; ?></p>

          <!-- Task Stats -->
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

          <!-- Role Change Option (only if current user is admin) -->
          <?php if ($isAdmin && $id_contributor != $id_user): ?>
            <hr>
            <h6 class="mb-2">Change Role</h6>
            <input type="hidden" name="id_user" value="<?php echo $id_contributor; ?>">
            <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
            <div class="form-group">
              <select name="new_role" class="form-control">
                <option value="member" <?= $role === 'member' ? 'selected' : '' ?>>Member</option>
                <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
              </select>
            </div>
          <?php endif; ?>
        </div>

        <div class="modal-footer">
          <?php if ($isAdmin && $id_contributor != $id_user): ?>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          <?php endif; ?>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>