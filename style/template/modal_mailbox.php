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
if ($table_related === 'invitation' && $id_related) {
  $q = mysqli_query($conn, "SELECT status FROM invitation WHERE id = '$id_related'");
  if ($data = mysqli_fetch_assoc($q)) {
    $invitationStatus = $data['status'];
    if ($invitationStatus === 'pending') {
      echo "
      <div class='text-center'>
        <form method='post' action='config/proses_invitation.php' class='d-inline'>
          <input type='hidden' name='id_invitation' value='$id_related'>
          <input type='hidden' name='action' value='accepted'>
          <button type='submit' class='btn btn-success mr-2'>✅ Accept</button>
        </form>
        <form method='post' action='config/proses_invitation.php' class='d-inline'>
          <input type='hidden' name='id_invitation' value='$id_related'>
          <input type='hidden' name='action' value='declined'>
          <button type='submit' class='btn btn-danger'>❌ Decline</button>
        </form>
      </div>";
    } else {
      echo "
      <div class='text-center mt-3'>
        <button class='btn btn-outline-secondary' disabled>
          ✅ Kamu sudah merespon undangan ini (<strong>" . ucfirst($invitationStatus) . "</strong>)
        </button>
      </div>";
    }
  }

} elseif ($id_related && in_array($type, ['project', 'task', 'comment', 'reminder', 'general', 'task update'])) {
  $redirectUrl = '#';
  $showButton = true;
  switch ($type) {
    case 'general':
      $showButton = false;
      echo "
      <div class='text-center'>
        <button class='btn btn-primary' data-dismiss='modal'>Ok</button>
      </div>";
      break;

    case 'task update':
    case 'task':
    case 'reminder':
      // Ambil id_project dari task
      $taskQuery = mysqli_query($conn, "SELECT id_project FROM task WHERE id_task = '$id_related'");
      if ($taskData = mysqli_fetch_assoc($taskQuery)) {
        $projectId = $taskData['id_project'];
        $redirectUrl = "?page=project&&id=$projectId";
      }
      break;

    case 'comment':
      $redirectUrl = "?page=project&&comment=$id_related";
      break;

    case 'project':
      $showButton = false;
      echo "
      <div class='text-center'>
        <button class='btn btn-primary' data-dismiss='modal'>Ok</button>
      </div>";
      break;
  }

  if ($showButton && $redirectUrl !== '#') {
    echo "
    <div class='text-center'>
      <a href='$redirectUrl' class='btn btn-primary'>🔍 View Detail</a>
    </div>";
  }
}
?>      </div>
    </div>
  </div>
</div>