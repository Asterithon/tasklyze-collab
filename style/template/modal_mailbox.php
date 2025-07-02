<div class="modal fade" id="notif<?php echo $notif_id; ?>" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= ucfirst(str_replace('_', ' ', $type)) ?></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p class="text-dark"><?= $pesan ?></p>
        <small class="text-muted d-block text-right mb-3"><?= $tanggal ?></small>

<?php
if ($type === 'invitation' && $id_related) {
  $q = mysqli_query($conn, "SELECT status FROM invitation WHERE id = '$id_related'");
  if ($data = mysqli_fetch_assoc($q)) {
    $invitationStatus = $data['status'];
    if ($invitationStatus === 'pending') {
      echo "
      <div class='text-center'>
        <a href='config/proses_invitation.php?id_invitation=$id_related&action=accepted' class='btn btn-success mr-2'>✅ Accept</a>
        <a href='config/proses_invitation.php?id_invitation=$id_related&action=declined' class='btn btn-danger'>❌ Decline</a>
      </div>";
    } else {
      echo "
      <div class='text-center mt-3'>
        <button class='btn btn-outline-secondary' disabled>
          ✅ You have already responded to this invitation (<strong>" . ucfirst($invitationStatus) . "</strong>)
        </button>
      </div>";
    }
  }
}

elseif ($type === 'task' && $id_related) {
$qiTask = mysqli_query($conn, "SELECT status_task, id_project FROM task WHERE id_task = '$id_related'");
if ($taskData = mysqli_fetch_assoc($qiTask)) {
  $proj_id = $taskData['id_project'];
  $redirectUrl = "?page=project&id=$proj_id";

  if ($taskData['status_task'] === 'request') {
    echo "
    <div class='text-center'>
      <a href='config/proses_task_request.php?id_task=$id_related&action=accept' class='btn btn-success mr-2'>✅ Accept</a>
      <a href='config/proses_task_request.php?id_task=$id_related&action=decline' class='btn btn-danger'>❌ Decline</a>
    </div>";
  } else {
    echo "
    <div class='text-center'>
      <a href='$redirectUrl' class='btn btn-primary'>🔍 View Task</a>
    </div>";
  }
} else {
  // Task tidak ditemukan (mungkin sudah di-decline dan dihapus)
  echo "
  <div class='text-center mt-3'>
    <button class='btn btn-outline-secondary' disabled>
      ❌ This task request is no longer available (possibly declined or deleted).
    </button>
  </div>";
}
}

elseif ($id_related && in_array($type, ['project', 'comment', 'reminder', 'general', 'task update'])) {
  switch ($type) {
    case 'project':
      echo "
      <div class='text-center'>
        <button class='btn btn-primary' data-dismiss='modal'>Ok</button>
      </div>";
      break;

    case 'task update':
    case 'comment':
      $redirectUrl = "?page=project&id=$id_related";
      echo "
      <div class='text-center'>
        <a href='$redirectUrl' class='btn btn-primary'>🔍 View Detail</a>
      </div>";
      break;

    case 'reminder':
      $redirectUrl = "?page=project&id=$id_related";
      echo "
      <div class='text-center'>
        <a href='$redirectUrl' class='btn btn-primary'>🔍 View Detail</a>
      </div>";
      break;

    case 'general':
      $redirectUrl = "?page=notification&id=$id_related";
      echo "
      <div class='text-center'>
        <a href='$redirectUrl' class='btn btn-primary'>🔍 View Detail</a>
      </div>";
      break;
  }
}
?>      
      </div>
    </div>
  </div>
</div>