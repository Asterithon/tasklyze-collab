<?php
$id_user = $_SESSION['id_user'];
$id_project = $_GET['id'];

$qRole = mysqli_query($conn, "
  SELECT role FROM r_user_project 
  WHERE id_user = '$id_user' AND id_project = '$id_project'
");

$dataRole = mysqli_fetch_assoc($qRole);
$isAdmin = isset($dataRole['role']) && $dataRole['role'] === 'admin';
?>

<div class="modal fade" id="newTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form id="taskForm" class="modal-content" action="config/aksi_new_task.php?id=<?php echo $_GET['id']; ?>"
      method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="newTaskModalLabel">New Task</h5>
      </div>
<div class="modal-body">
  <?php if (!$isAdmin): ?>
    <div class="alert alert-warning" role="alert">
      ⚠️ You do not have permission to create tasks directly. Your task will be submitted for admin approval.
    </div>
  <?php endif; ?>

  <div class="mb-4">
    <label for="taskTitle" class="form-label">Title</label>
    <input type="hidden" name="status" value="<?= $isAdmin ? 'progress' : 'request' ?>">
    <input type="text" class="form-control" id="taskTitle" name="taskTitle"
      placeholder="Enter task title" required autocomplete="off" />
    <div id="titleHelp" class="form-text">Provide a short title for the task.</div>
  </div>

  <div class="mb-4">
    <label for="taskDescription" class="form-label">Description</label>
    <textarea class="form-control" id="taskDescription" name="taskDescription" rows="4"
      placeholder="Enter detailed description" required></textarea>
    <div id="descHelp" class="form-text">Add helpful details about the task.</div>
  </div>

  <!-- Hidden status field -->
  <input type="hidden" name="status" value="<?= $isAdmin ? 'progress' : 'request' ?>">
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Cancel">Cancel</button>
        <button type="submit" class="btn btn-primary" aria-label="Save task">Create Task</button>
      </div>
    </form>
  </div>
</div>