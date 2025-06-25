<div class="content-wrapper kanban">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Kanban Board</h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kanban Board</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content pb-3">
        <div class="container-fluid h-100">

            <div class="card card-row card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Settings
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card card-light card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Description</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link">#7</a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>

                        </div>
                        <div class="card-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                Aenean commodo ligula eget dolor. Aenean massa.
                                Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus.
                            </p>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Create New Task</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link">#6</a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Users</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link">#3</a>
                                <a href="" class="btn btn-tool" data-toggle="modal" data-target="#modal-xl">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $id_project = $_GET['id'];
                            $id_user = $_SESSION['id_user'];

                            $sql = "SELECT user.id_user, user.username, r_user_project.role
        FROM r_user_project 
        LEFT JOIN user ON r_user_project.id_user = user.id_user
        WHERE r_user_project.id_project = '$id_project'";
                            $result = mysqli_query($conn, $sql);

                            $contributors = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $contributors[] = $row;
                            }

                            if (!empty($contributors) && (count($contributors) > 1 || $contributors[0]['id_user'] != $id_user)) {
                                $index = 1;
                                foreach ($contributors as $row) {
                                    $checkboxId = "customCheckbox" . $index;
                                    $nama = $row['username'];
                                    $role = $row['role'];
                                    $isCurrentUser = ($row['id_user'] == $id_user);

                                    $badgeLabel = $isCurrentUser ? "<span class='text-primary me-2'>you</span><span class='badge badge-secondary'>$role</span>"
                                        : "<span class='badge badge-secondary'>$role</span>";

                                    echo "
        <div class='custom-control custom-checkbox d-flex justify-content-between align-items-center'>
            <div>
                <input class='custom-control-input' type='checkbox' id='$checkboxId' disabled>
                <label for='$checkboxId' class='custom-control-label mb-0'>$nama</label>
            </div>
            <div class='d-flex align-items-center'>
                $badgeLabel
            </div>
        </div>";
                                    $index++;
                                }
                            } else {
                                // Tampilkan user sendiri jika tidak ada kontributor lain
                                $userRow = $contributors[0];
                                $nama = $userRow['username'];
                                $role = $userRow['role'];

                                echo "
    <div class='custom-control custom-checkbox d-flex justify-content-between align-items-center'>
        <div>
            <input class='custom-control-input' type='checkbox' id='customCheckbox1' disabled checked>
            <label for='customCheckbox1' class='custom-control-label mb-0'>$nama</label>
        </div>
        <div class='d-flex align-items-center'>
            <span class='badge badge-primary me-2'>you</span>
            <span class='badge badge-secondary'>$role</span>
        </div>
    </div>
    <p class='text-muted text-center mt-3'>🤝 Belum ada kontributor lain di project ini.</p>";
                            }
                            ?> </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Invite</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link">#4</a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" disabled>
                                <label for="customCheckbox1_1" class="custom-control-label">Bug Report</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox1_2" disabled>
                                <label for="customCheckbox1_2" class="custom-control-label">Feature Request</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card card-row card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        To Do
                    </h3>
                </div>
                <div class="card-body">
                    <?php include("style/template/task_list.php"); ?>
                    <div class="card card-primary card-outline" data-bs-toggle="modal"
                        data-bs-target="#newTask">
                        <div class="card-header">
                            <h5 class="card-title">Create New Task</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include("style/template/new_task.php"); ?>
            </div>

            <div class="card card-row card-default">
                <div class="card-header bg-info">
                    <h3 class="card-title">
                        In Progress
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card card-light card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Update Readme</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link">#2</a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                Aenean commodo ligula eget dolor. Aenean massa.
                                Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-row card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        Done
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Create repo</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link">#1</a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

<!-- modal invite -->
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Contributors</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Kontributor Aktif -->
                    <div class="col-md-6 border-right pr-3" style="max-height: 33vh; overflow-y: auto;">
                        <h6 class="text-primary mb-3">👥 Current Contributors</h6>

                        <?php
                        $id_project = $_GET['id'];
                        $id_user = $_SESSION['id_user'];

                        $sql = "SELECT user.id_user, user.username, r_user_project.role
            FROM r_user_project 
            JOIN user ON r_user_project.id_user = user.id_user
            WHERE r_user_project.id_project = '$id_project'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $nama = $row['username'];
                                $role = $row['role'];
                                $tag = $row['id_user'] == $id_user ? "<span class='text-info mr-2'>you</span>" : "";

                                echo "
                                <div class='d-flex justify-content-between align-items-center mb-2'>
                                <div class='text-truncate'><i class='fas fa-user text-muted mr-2'></i> $nama</div>
                                <div>$tag<span class='badge badge-secondary'>$role</span></div>
                                </div>";
                                $i++;
                            }
                        } else {
                            echo "<p class='text-muted'>Belum ada kontributor untuk project ini.</p>";
                        }
                        ?>
                            <h6 class="text-success mb-3 mt-5">⏳ Pending Invitations</h6>

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