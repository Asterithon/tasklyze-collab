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
              ?>
              <div class='text-center'>
                <!-- <form method='post' action='config/proses_invitation.php' class='d-inline'>
                  <input type='hidden' name='id_invitation' value='$id_related'>
                  <input type='hidden' name='action' value='accepted'>
                  <button type='submit' class='btn btn-success mr-2'>✅ Accept</button>
                </form> -->
                <a href="config/proses_invitation.php?id_invitation=<?php echo $id_related ?>&&action=accepted"
                  class='btn btn-success mr-2'>✅ Accept</a>
                <a href="config/proses_invitation.php?id_invitation=<?php echo $id_related ?>&&action=declined"
                  class='btn btn-danger mr-2'>❌ Decline</a>
                <!-- <form method='post' action='config/proses_invitation.php' class='d-inline'>
                  <input type='hidden' name='id_invitation' value='$id_related'>
                  <input type='hidden' name='action' value='declined'>
                  <button type='submit' class='btn btn-danger'>❌ Decline</button>
                </form> -->
              </div>
            <?php } else {
              echo "
              <div class='text-center mt-3'>
                <button class='btn btn-outline-secondary' disabled>
                  ✅ Kamu sudah merespon undangan ini (<strong>" . ucfirst($invitationStatus) . "</strong>)
                </button>
              </div>";
            }
          }
        } elseif ($id_related && in_array($table_related, ['project', 'task', 'comment', 'reminder', 'general', 'task update'])) {
          // Tentukan URL tujuan berdasarkan table_related
          $redirectUrl = '#';
          switch ($table_related) {
            case 'project':
              echo "
          <div class='text-center'>
            <button class='btn btn-primary' data-dismiss='modal'>Ok</button>
          </div>";
              break;
            case 'task':
            case 'task update':
              $redirectUrl = "../?page=project&task=$id_related";
              echo "
          <div class='text-center'>
            <a href='$redirectUrl' class='btn btn-primary'>🔍 View Detail</a>
          </div>";
              break;
            case 'comment':
              $redirectUrl = "../?page=project&comment=$id_related";
              break;
            case 'reminder':
              $redirectUrl = "../?page=reminder&id=$id_related";
              echo "
          <div class='text-center'>
            <a href='$redirectUrl' class='btn btn-primary'>🔍 View Detail</a>
          </div>";
              break;
            case 'general':
              $redirectUrl = "../?page=notification&id=$id_related";
              break;
          }


        }
        ?>
      </div>
    </div>
  </div>
</div>