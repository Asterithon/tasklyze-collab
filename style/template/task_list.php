<?php
$filter = $_GET['filter'] ?? 'all'; // default: all
?>

<div class="row align-items-start mb-4">
  <div class="col-md-6 col-lg-4">
    <div class="card border-0 shadow-sm">
      <div class="card-body p-3">
        <form method="GET" action="" class="d-flex flex-column">
          <input type="hidden" name="page" value="project">
          <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

          <label for="filter-select" class="form-label fw-semibold text-secondary mb-2">
            <i class="fas fa-filter me-2"></i>Filter Tasks
          </label>

          <div class="input-group">
            <span class="input-group-text bg-primary text-white border-primary">
              <i class="fas fa-tasks"></i>
            </span>
            <select name="filter" id="filter-select" class="form-select border-primary" onchange="this.form.submit()">
              <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>
                <i class="fas fa-list"></i> All Tasks
              </option>
              <option value="taken" <?= $filter === 'taken' ? 'selected' : '' ?>>
                <i class="fas fa-user-check"></i> Taken Tasks
              </option>
              <option value="done" <?= $filter === 'done' ? 'selected' : '' ?>>
                <i class="fas fa-check-circle"></i> Done Tasks
              </option>
              <option value="yours" <?= $filter === 'yours' ? 'selected' : '' ?>>
                <i class="fas fa-user"></i> Your Tasks
              </option>
              <option value="yourdone" <?= $filter === 'yourdone' ? 'selected' : '' ?>>
                <i class="fas fa-user-check"></i> Your Done Tasks
              </option>
            </select>
          </div>

          <!-- Optional manual submit button (hidden by default since onchange handles it) -->
          <button type="submit" class="btn btn-primary btn-sm mt-2 d-none" id="filter-submit">
            <i class="fas fa-search me-1"></i> Apply Filter
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include("inc/connec.php");
$f_id_project = $_GET['id'];
$id_user = $_SESSION['id_user'];

switch ($filter) {
  case 'taken':
    $sql = "SELECT * FROM task 
            WHERE id_project = $f_id_project 
            AND id_task IN (SELECT id_task FROM r_user_task)";
    break;

  case 'done':
    $sql = "SELECT t.* FROM task t
WHERE t.id_project = $f_id_project
AND EXISTS (
  SELECT 1 FROM r_user_task r
  WHERE r.id_task = t.id_task
)
AND NOT EXISTS (
  SELECT 1 FROM r_user_task r
  WHERE r.id_task = t.id_task AND r.status != 'done'
)
            ";
    break;

  case 'yours':
    $sql = "SELECT t.* FROM task t
            JOIN r_user_task r ON t.id_task = r.id_task
            WHERE t.id_project = $f_id_project AND r.id_user = $id_user
            ORDER BY FIELD(r.status, 'assigned', 'in progress', 'done')";
    break;

  case 'yourdone':
    $sql = "SELECT t.* FROM task t
            JOIN r_user_task r ON t.id_task = r.id_task
            WHERE t.id_project = $f_id_project AND r.id_user = $id_user AND r.status = 'done'";
    break;

  default:
    $sql = "SELECT * FROM task WHERE id_project = $f_id_project ANd status_task != 'request' 
            ORDER BY created_at DESC";
    break;
}

$res1 = mysqli_query($conn, $sql);
$index = 0;
if (mysqli_num_rows($res1) === 0): ?>
  <div class="d-flex justify-content-center align-items-center text-center" style="height: 300px; width: 100%;">
    <div>
      <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
      <h5 class="text-muted">No tasks found</h5>
      <p class="text-muted">Try changing the filter or <a href="?page=project&&id=<?php echo $id_project; ?>">reload
          this
          page</a>.</p>
    </div>
  </div>
<?php else: ?>
  <div class="d-flex flex-wrap mt-4 row gap-3">
    <?php

    while ($data = mysqli_fetch_array($res1)) {

      $task_id = $data['id_task'];
      $taskdate = date('d M Y, H:i', strtotime($data['created_at']));

      // Hitung total contributor
      $q_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM r_user_task WHERE id_task = '$task_id'");
      $total = mysqli_fetch_assoc($q_total)['total'];

      // Hitung contributor yang sudah selesai
      $q_done = mysqli_query($conn, "SELECT COUNT(*) AS done FROM r_user_task WHERE id_task = '$task_id' AND status = 'done'");
      $done = mysqli_fetch_assoc($q_done)['done'];
      ?>
      <div class="p-2 col-4">
        <div class="card card-outline card-primary text-truncate" style="cursor: pointer;" data-bs-toggle="modal"
          data-bs-target="#taskDetail<?php echo $task_id; ?>">
          <div class="card-header p-2">
            <h6 class="card-title text-truncate d-inline-block w-100 mb-0"><?php echo $data['name_task']; ?></h6>
          </div>
          <div class="card-body p-2">
            <p class="small text-truncate mb-1"><?php echo $data['desc_task']; ?></p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">
                👥 <?php echo "done: $done / $total"; ?>
              </small>
              <small class="text-muted"><?php echo $taskdate; ?></small>
            </div>
          </div>
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
              <p class="text-secondary"><?php echo $taskdate; ?></p>

              <?php
              $id_task = $data['id_task'];
              $assignedQuery = "
  SELECT u.id_user, u.username, u.email, rut.status 
  FROM r_user_task rut
  JOIN user u ON rut.id_user = u.id_user
  WHERE rut.id_task = '$id_task'
";
              $assignedResult = mysqli_query($conn, $assignedQuery);

              if (mysqli_num_rows($assignedResult) > 0) {
                echo "<div class='table-responsive'>
          <table class='table table-sm table-hover mb-0'>
            <tbody>";
                while ($row = mysqli_fetch_assoc($assignedResult)) {
                  $username = $row['username'];
                  $email = $row['email'];
                  $status = ucfirst($row['status']);
                  $id_contributor = $row['id_user'];

                  echo "
      <tr class='contributor-row' style='cursor: default;'>
        <td>
          <div class='d-flex align-items-center '>
            <i class='fas fa-user text-muted mx-3 mt-1'></i>
            <div>
              <div class='font-weight-bold mb-1'>$username</div>
              <div class='text-muted small'>$email</div>
            </div>
          </div>
        </td>
        <td class='text-right align-middle'>
          <span class='badge badge-light' style='min-width: 80px;'>$status</span>
        </td>
      </tr>";
                }
                echo "    </tbody>
          </table>
        </div>";
              } else {
                echo "<p class='text-muted'>No contributors assigned to this task yet.</p>";
              }
              ?>

              <hr>

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
          AND u.id_user != '$id_user'
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


  <!-- Admin: Self-task actions -->
  <?php if ($isAssigned): 
    $statusQuery = mysqli_query($conn, "SELECT status FROM r_user_task WHERE id_user = '$id_user' AND id_task = '$id_task'");
    $statusData = mysqli_fetch_assoc($statusQuery);
    $currentStatus = $statusData['status'] ?? '';
  ?>
    <h6 class="mb-2 mt-3">Leave or Update Your Task Status</h6>
    <div class="d-flex justify-content-between">
      <form method="POST" action="config/aksi_self_task.php" class="me-2">
        <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
        <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
        <button type="submit" name="action" value="leave" class="btn btn-outline-danger">Leave Task</button>
      </form>

      <form method="POST" action="config/aksi_self_task.php">
        <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
        <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
        <?php if ($currentStatus === 'done'): ?>
          <button type="submit" name="action" value="mark_progress" class="btn btn-outline-warning">Back to Progress</button>
        <?php else: ?>
          <button type="submit" name="action" value="mark_done" class="btn btn-outline-success">Mark as Done</button>
        <?php endif; ?>
      </form>
    </div>
  <?php else: ?>
    <!-- Admin: Assign self if not yet assigned -->
    <form method="POST" action="config/aksi_self_task.php" class="mt-3">
      <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
      <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
      <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
      <h6 class="mb-2">Assign This Task to Yourself</h6>
      <button type="submit" name="action" value="assign" class="btn btn-outline-primary">Assign to Me</button>
    </form>
  <?php endif; ?>

              <?php elseif ($userRole === 'member'): ?>
                <!-- Member: Assign self or leave task -->
                <form method="POST" action="config/aksi_self_task.php">
                  <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
                  <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
                  <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                  <?php if (!$isAssigned): ?>
                    <h6 class="mb-2">Assign This Task</h6>
                    <button type="submit" name="action" value="assign" class="btn btn-outline-primary">Assign to Me</button>
                  <?php else:
                    $statusQuery = mysqli_query($conn, "SELECT status FROM r_user_task WHERE id_user = '$id_user' AND id_task = '$id_task'");
                    $statusData = mysqli_fetch_assoc($statusQuery);
                    $currentStatus = $statusData['status'] ?? '';
                    ?>
                    <h6 class="mb-2">Leave or Update Your Task Status</h6>
                    <div class="d-flex justify-content-between">
                      <form method="POST" action="config/aksi_self_task.php" class="me-2">
                        <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
                        <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
                        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                        <button type="submit" name="action" value="leave" class="btn btn-outline-danger">Leave Task</button>
                      </form>

                      <form method="POST" action="config/aksi_self_task.php">
                        <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
                        <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
                        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                        <?php if ($currentStatus === 'done'): ?>
                          <button type="submit" name="action" value="mark_progress" class="btn btn-outline-warning">Back to
                            Progress</button>
                        <?php else: ?>
                          <button type="submit" name="action" value="mark_done" class="btn btn-outline-success">Mark as
                            Done</button>
                        <?php endif; ?>
                      </form>
                    </div>

                  <?php endif; ?>
                </form>
              <?php endif; ?>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
              <div>
                <?php
                $roleQuery = mysqli_query($conn, "SELECT role FROM r_user_project WHERE id_user = '$id_user' AND id_project = '$id_project'");
                $roleData = mysqli_fetch_assoc($roleQuery);
                $isAdmin = ($roleData['role'] ?? '') === 'admin';

                if ($isAdmin): ?>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#taskUpdate<?php echo $data['id_task']; ?>">
                    Update
                  </button>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#taskDelete<?php echo $data['id_task']; ?>">
                    Delete
                  </button>
                <?php endif; ?>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      include("style/template/update_task.php");
      include("style/template/delete_task.php");
    } ?>
  </div><?php endif; ?>