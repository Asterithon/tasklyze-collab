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
      <p class="text-secondary"><?php echo $data['start_task']; ?></p>
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
        </div>
        <div class="modal-footer justify-content-between">
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
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php
  include("style/template/update_task.php");
  include("style/template/delete_task.php");
} ?>