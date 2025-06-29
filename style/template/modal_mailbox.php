  <!-- detail modal -->
  <div class="modal fade" id="notif<?php echo $notif_id; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNotifTitle">Detail</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p id="modalNotifMessage" class="text-dark"></p>
          <small id="modalNotifDate" class="text-muted d-block text-right mb-3"></small>

          <!-- Tombol tindakan untuk invitation -->
          <?php

          $showInvitationActions = false;
          $hasResponded = false;
          $invitationStatus = '';

          if ($id_related) {
            $q = mysqli_query($conn, "SELECT status FROM invitation WHERE id = '$id_related'");
            if ($data = mysqli_fetch_assoc($q)) {
              $invitationStatus = $data['status'];
              $showInvitationActions = ($invitationStatus === 'pending');
              $hasResponded = in_array($invitationStatus, ['accepted', 'declined']);
            }
          }

          ?>
          <?php if ($showInvitationActions): ?>
            <div id="invitationActions" class="text-center">
              <form method="post" action="config/proses_invitation.php" class="d-inline">
                <input type="hidden" name="id_invitation" value="<?= $id_related ?>">
                <input type="hidden" name="action" value="accepted">
                <button type="submit" class="btn btn-success mr-2">✅ Accept</button>
              </form>
              <form method="post" action="config/proses_invitation.php" class="d-inline">
                <input type="hidden" name="id_invitation" value="<?= $id_related ?>">
                <input type="hidden" name="action" value="declined">
                <button type="submit" class="btn btn-danger">❌ Decline</button>
              </form>
            </div>
          <?php elseif ($hasResponded): ?>
            <div class="text-center mt-3">
              <button class="btn btn-outline-secondary" disabled>
                ✅ Kamu sudah merespon undangan ini (<strong><?= ucfirst($invitationStatus) ?></strong>)
              </button>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
