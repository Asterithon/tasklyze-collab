
<!-- modal invite -->
<div class="modal fade" id="modal-contributor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Contributors</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Kontributor Aktif -->
                    <div class="col-md-6 border-right pr-3" style="max-height: 33vh; overflow-y: auto;">
                            <h6 class="text-success mb-3">⏳ Pending Invitations</h6>

                            <div class="table-responsive mt-4">
    <table class="table table-hover mb-0">
        <tbody>
            <?php
            $sqlPending = "SELECT i.id_receiver, u.username, u.email
                           FROM invitation i
                           JOIN user u ON i.id_receiver = u.id_user
                           WHERE i.id_project = '$id_project' AND i.status = 'pending'";
            $resPending = mysqli_query($conn, $sqlPending);

            if (mysqli_num_rows($resPending) > 0) {
                while ($row = mysqli_fetch_assoc($resPending)) {
                    $nama = $row['username'];
                    $email = $row['email'];

                    echo "
                    <tr>
                        <td>
                            <div class='font-weight-bold mb-1'>$nama</div>
                            <div class='text-muted small'>$email</div>
                        </td>
                        <td class='text-right align-middle'>
                            <span class='badge badge-warning' style='min-width: 80px;'>invited</span>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='text-muted text-center'>Tidak ada undangan pending saat ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
                    </div>

                    <!-- Tambahkan Kontributor Baru -->
                    <div class="col-md-6 pl-3" style="max-height: 33vh; overflow-y: auto;">
                        <h6 class="text-success mb-3">➕ Add Contributors</h6>

                        <!-- Search box -->
                        <div class="form-group mb-3">
                            <input type="text" id="searchUser" class="form-control" placeholder="Cari user...">
                        </div>
                        <form method="POST" action="config/aksi_invite.php?id=<?= $_GET['id'] ?>">

<div class="table-responsive mt-4">
    <table class="table table-hover mb-0">
        <tbody>
            <?php
            $sqlNew = "SELECT u.id_user, u.username, u.email
                       FROM user u
                       WHERE u.id_user NOT IN (
                         SELECT id_user FROM r_user_project WHERE id_project = '$id_project'
                       )
                       AND u.id_user NOT IN (
                         SELECT id_receiver FROM invitation
                         WHERE id_project = '$id_project' AND status = 'pending'
                       )";
            $resNew = mysqli_query($conn, $sqlNew);

            if (mysqli_num_rows($resNew) > 0) {
                while ($u = mysqli_fetch_assoc($resNew)) {
                    $id = $u['id_user'];
                    $username = $u['username'];
                    $email = $u['email'];

                    echo "
                    <tr class='user-row' style='cursor: pointer;' data-id='user$id'>
                        <td>
                            <div class='font-weight-bold mb-1'>$username</div>
                            <div class='text-muted small'>$email</div>
                        </td>
                        <td class='text-right align-middle'>
                            <input type='checkbox' name='invite_users[]' value='$id' id='user$id' class='form-check-input'>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='text-muted text-center'>Semua user telah bergabung atau sedang menunggu respon undangan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnUndang" disabled>Undang</button></form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<script>
document.addEventListener('DOMContentLoaded', function () {
  // 🔍 Filter user berdasarkan input pencarian
  document.getElementById("searchUser").addEventListener("input", function () {
    const filter = this.value.toLowerCase();
    document.querySelectorAll(".user-row").forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(filter) ? "" : "none";
    });
  });

  // ✅ Toggle checkbox saat baris diklik (kecuali klik langsung pada checkbox)
  document.querySelectorAll(".user-row").forEach(row => {
    row.addEventListener("click", function (e) {
      if (e.target.tagName.toLowerCase() === 'input') return;
      const checkboxId = this.dataset.id;
      const checkbox = document.getElementById(checkboxId);
      if (checkbox) {
        checkbox.checked = !checkbox.checked;
        checkbox.dispatchEvent(new Event('change')); // trigger update tombol
      }
    });
  });

  // 🔘 Aktifkan tombol "Undang" jika ada yang dicentang
  const checkboxes = document.querySelectorAll("input[name='invite_users[]']");
  const btnUndang = document.getElementById("btnUndang");

  function updateButtonState() {
    const isChecked = Array.from(checkboxes).some(cb => cb.checked);
    btnUndang.disabled = !isChecked;
  }

  checkboxes.forEach(cb => {
    cb.addEventListener("change", updateButtonState);
  });

  // Inisialisasi awal
  updateButtonState();
});
</script>