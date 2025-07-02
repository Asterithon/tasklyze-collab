<?php
include 'inc/connec.php';
$id_project = $_GET['id']  ?? null;
$sql_project = "SELECT name_project, desc_project FROM project WHERE id_project = '$id_project'";
$result_project = mysqli_query($conn, $sql_project);
$id_user = $_SESSION['id_user'];

if (!$id_project) {
  // Tidak ada ID project
echo "<script>window.location.href = '?page=dashboard';</script>";
exit;
}

// Cek apakah user terdaftar di project ini
$q = mysqli_query($conn, "SELECT 1 FROM r_user_project WHERE id_user = '$id_user' AND id_project = '$id_project'");
if (mysqli_num_rows($q) === 0) {
  // User tidak punya akses ke project ini
echo "<script>window.location.href = '?page=dashboard';</script>";
exit;
}


if ($result_project && mysqli_num_rows($result_project) > 0) {
    $row_project = mysqli_fetch_assoc($result_project);
    $name_project = htmlspecialchars($row_project['name_project']);
    $desc_project = nl2br(htmlspecialchars($row_project['desc_project']));
} else {
    $name_project = "Project Tidak Ditemukan";
    $desc_project = "Deskripsi tidak tersedia.";
}
?>

<div class="content-wrapper kanban">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1><?= $name_project; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content pb-3">
        <div class="container-fluid w-100 pr-4 h-100" style="min-width: 1500px;">

            <div class="card card-row card-secondary " style="min-width: 25%;">
                <div class="card-header">
                    <h3 class="card-title">
                        Settings
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card card-light card-outline">
                        <div class="card-header">
                            <h5 class="card-title"><?= $name_project ?></h5>
                            <div class="card-tools">

                                <a href="#" class="btn btn-tool" data-bs-toggle="modal"
                                    data-bs-target="#projectEdit<?php echo $id_project; ?>">

                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div><?php include "style/template/edit_project.php"; ?>
                        <div class="card-body">
                            <p><?= $desc_project ?></p>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header" data-bs-toggle="modal" data-bs-target="#newTask"
                            style='cursor: pointer;'>
                            <h5 class="card-title">Create New Task</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link"></a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info card-outline">
                        <div class="card-header" style='cursor: pointer;' data-toggle="modal"
                            data-target="#modal-contributor">
                            <h5 class="card-title">Contributors</h5>
                            <div class="card-tools">

                                <a class="btn btn-tool">
                                    <i class="fa-solid fa-plus"></i>
                                </a>

                            </div>
                        </div><?php include "style/template/new_contributors.php"; ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        <?php
                                        $id_project = $_GET['id'];
                                        $id_user = $_SESSION['id_user'];

                                        $sql = "SELECT user.id_user, user.username, user.email, r_user_project.role
                                        FROM r_user_project
                                        JOIN user ON r_user_project.id_user = user.id_user
                                        WHERE r_user_project.id_project = '$id_project'
                                        ORDER BY 
                                            CASE r_user_project.role
                                                WHEN 'admin' THEN 0
                                                WHEN 'member' THEN 1
                                                ELSE 2
                                            END,
                                            user.username ASC";

                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $id_contributor = $row['id_user'];
                                                $nama = $row['username'];
                                                $email = $row['email'];
                                                $role = $row['role'];
                                                $tag = $id_contributor == $id_user ? "<span class='text-info mr-2'>you</span>" : '';

                                                echo "
                                                <tr class='contributor-row' 
                                                    data-toggle='modal' 
                                                    data-target='#modalChangeRole$id_contributor' 
                                                    style='cursor: pointer;'>
                                                    <td>
                                                    <div class='font-weight-bold mb-1'>$nama</div>
                                                    <div class='text-muted small'>$email</div>
                                                    </td>
                                                    <td class='text-right align-middle'>
                                                    $tag
                                                    <span class='badge badge-secondary' style='min-width: 80px;'>$role</span>
                                                    </td>
                                                </tr>";

                                                include("style/template/contributors_role.php");
                                            }
                                        } else {
                                            echo "<tr><td colspan='2' class='text-muted text-center'>Belum ada kontributor untuk project ini.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Stats</h5>
                            <div class="card-tools">
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

            <div class="card card-row card-primary" style="min-width: 75%;">
                <div class="card-header">
                    <h3 class="card-title">
                        To Do
                    </h3>
                </div>
                <div class="card-body">
                    <?php include("style/template/task_list.php"); ?>
                </div>
                <?php include("style/template/new_task.php"); ?>
            </div>



        </div>
    </section>


</div>