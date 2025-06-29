
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

                            <?php
                            $sqlPending = "SELECT i.id_receiver, u.username
                   FROM invitation i
                   JOIN user u ON i.id_receiver = u.id_user
                   WHERE i.id_project = '$id_project' AND i.status = 'pending'";
                            $resPending = mysqli_query($conn, $sqlPending);

                            if (mysqli_num_rows($resPending) > 0) {
                                while ($row = mysqli_fetch_assoc($resPending)) {
                                    $nama = $row['username'];
                                    echo "
            <div class='d-flex justify-content-between align-items-center mb-2'>
                <div class='text-truncate'><i class='fas fa-user-clock text-secondary mr-2'></i> $nama</div>
                <div><span class='badge badge-warning'>invited</span></div>
            </div>";
                                }
                            } else {
                                echo "<p class='text-muted'>Tidak ada undangan pending saat ini.</p>";
                            }
                            ?>
                    </div>

                    <!-- Tambahkan Kontributor Baru -->
                    <div class="col-md-6 pl-3" style="max-height: 33vh; overflow-y: auto;">
                        <h6 class="text-success mb-3">➕ Add Contributors</h6>

                        <!-- Search box -->
                        <div class="form-group mb-3">
                            <input type="text" id="searchUser" class="form-control" placeholder="Cari user...">
                        </div>
                        <form method="POST" action="config/aksi_invite.php?id=<?= $_GET['id'] ?>">

<?php
// Ambil user yang belum tergabung dan belum memiliki undangan accepted/pending
$sqlNew = "SELECT id_user, username FROM user 
           WHERE id_user NOT IN (
               SELECT id_user FROM r_user_project WHERE id_project = '$id_project'
           )
           AND id_user NOT IN (
               SELECT id_receiver FROM invitation 
               WHERE id_project = '$id_project' AND status IN ('pending', 'accepted')
           )";
$resNew = mysqli_query($conn, $sqlNew);

if (mysqli_num_rows($resNew) > 0) {
    while ($u = mysqli_fetch_assoc($resNew)) {
        echo "
        <div class='form-check mb-2 user-item'>
            <input class='form-check-input' type='checkbox' name='invite_users[]' value='{$u['id_user']}' id='user{$u['id_user']}'>
            <label class='form-check-label' for='user{$u['id_user']}'>{$u['username']}</label>
        </div>";
    }
} else {
    echo "<p class='text-muted'>Semua user telah bergabung atau sedang menunggu respon undangan.</p>";
}
?>
                    </div>
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
    document.getElementById("searchUser").addEventListener("input", function() {
        const filter = this.value.toLowerCase();
        document.querySelectorAll(".user-item").forEach(item => {
            const name = item.textContent.toLowerCase();
            item.style.display = name.includes(filter) ? "" : "none";
        });
    });
    document.querySelectorAll("input[name='invite_users[]']").forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            const isChecked = Array.from(document.querySelectorAll("input[name='invite_users[]']")).some(c => c.checked);
            document.getElementById("btnUndang").disabled = !isChecked;
        });
    });
</script>