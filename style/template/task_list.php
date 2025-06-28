<?php
include("inc/connec.php");
$f_id_project = $_GET['id'];
$sql = "SELECT * FROM task WHERE id_project = $f_id_project";
$res = mysqli_query($conn, $sql);

$index = 0;
while ($data = mysqli_fetch_array($res)) {
  ?>

  <div class="card card-outline card-primary mb-3" data-bs-toggle="modal"
    data-bs-target="#taskDetail<?php echo $data['id_task']; ?>">
    <div class="card-header d-flex">
      <h5 class="card-title text-truncate mw-100 text-nowrap"><?php echo $data['name_task']; ?></h5>
    </div>
    <div class="card-body">
      <p><?php echo $data['desc_task']; ?></p>
      <p class="text-secondary"><?php echo $data['created_at']; ?></p>
    </div>
  </div>

  <div class="modal fade" id="taskDetail<?php echo $data['id_task']; ?>" tabindex="-1"
    aria-labelledby="taskDetailLabel<?php echo $index; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header d-block">
          <h5 class="modal-title flex-grow-1 text-wrap" style="white-space: normal;"
            id="taskDetailLabel<?php echo $data['id_task']; ?>">
            <?php echo $data['name_task']; ?>
          </h5>
        </div>
        <div class="modal-body">
          <?php echo $data['desc_task']; ?>
          <p class="text-secondary"><?php echo $data['created_at']; ?></p>
                <hr>
<h6 class="mb-2">Assigned Contributors</h6>
<?php
$id_task = $data['id_task'];
$assignedQuery = "
  SELECT u.username, rut.status 
  FROM r_user_task rut
  JOIN user u ON rut.id_user = u.id_user
  WHERE rut.id_task = '$id_task'
";
$assignedResult = mysqli_query($conn, $assignedQuery);

if (mysqli_num_rows($assignedResult) > 0) {
  echo "<ul class='list-unstyled'>";
  while ($row = mysqli_fetch_assoc($assignedResult)) {
    $username = $row['username'];
    $status = ucfirst($row['status']);
    echo "<li><i class='fas fa-user text-muted mr-2'></i> $username <span class='badge badge-light'>$status</span></li>";
  }
  echo "</ul>";
} else {
  echo "<p class='text-muted'>No contributors assigned to this task yet.</p>";
}
?>

<hr>
<h6 class="mb-2">Add Contributor</h6>
<?php
$id_project = $data['id_project'];
$id_task = $data['id_task'];
$id_user = $_SESSION['id_user'];

// Cek role user dalam project
$roleQuery = mysqli_query($conn, "SELECT role FROM r_user_project WHERE id_user = '$id_user' AND id_project = '$id_project'");
$roleData = mysqli_fetch_assoc($roleQuery);
$userRole = $roleData['role'] ?? '';

// Cek apakah user sudah ditugaskan ke task ini
$assignedCheck = mysqli_query($conn, "SELECT * FROM r_user_task WHERE id_user = '$id_user' AND id_task = '$id_task'");
$isAssigned = mysqli_num_rows($assignedCheck) > 0;
?>
<?php if ($userRole === 'admin'): ?>
  <!-- Admin: Assign other users -->
  <form method="POST" action="config/assign_contributor.php" class="form-inline">
    <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
    <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
    <input type="hidden" name="id_actor" value="<?php echo $id_user; ?>">
    <div class="form-group mb-2 mr-2">
      <select name="id_user" class="form-control" required>
        <option value="">Select user</option>
        <?php
        $userQuery = "
          SELECT u.id_user, u.username 
          FROM r_user_project rup
          JOIN user u ON rup.id_user = u.id_user
          WHERE rup.id_project = '$id_project'
          AND u.id_user NOT IN (
            SELECT id_user FROM r_user_task WHERE id_task = '$id_task'
          )
        ";
        $userResult = mysqli_query($conn, $userQuery);
        while ($u = mysqli_fetch_assoc($userResult)) {
          echo "<option value='{$u['id_user']}'>{$u['username']}</option>";
        }
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-success mb-2">Assign</button>
  </form>

<?php elseif ($userRole === 'member'): ?>
  <!-- Member: Assign self or leave task -->
  <form method="POST" action="config/aksi_self_task.php">
    <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
    <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
    <?php if (!$isAssigned): ?>
      <button type="submit" name="action" value="assign" class="btn btn-outline-primary">Assign to Me</button>
    <?php else: ?>
      <button type="submit" name="action" value="leave" class="btn btn-outline-danger">Leave Task</button>
    <?php endif; ?>
  </form>
<?php endif; ?>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
          <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#taskUpdate<?php echo $data['id_task']; ?>">
              Update
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
              data-bs-target="#taskDelete<?php echo $data['id_task']; ?>">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include("style/template/update_task.php");
  include("style/template/delete_task.php");
} ?>