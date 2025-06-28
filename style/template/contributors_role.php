
<!-- modal_change_role.php -->
<div class="modal fade" id="modalChangeRole<?php echo $id_contributor;?>" aria-labelledby="modalChangeRoleLabel<?php echo $id_contributor;?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="config/aksi_role.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Role Kontributor</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_user" value="<?php echo $id_contributor; ?>">
          <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
          <p>Ubah role untuk: <strong><?php echo $nama; ?></strong></p>
          <div class="form-group">
            <label for="newRole">Pilih Role Baru</label>
            <select name="new_role" id="newRole" class="form-control">
              <option value="member">Member</option>
              <option value="admin">Admin</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>