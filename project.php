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
    <?php
    $id_project = $_GET['id'];
    $sql_project = "SELECT name_project, desc_project FROM project WHERE id_project = '$id_project'";
    $result_project = mysqli_query($conn, $sql_project);

    if ($result_project && mysqli_num_rows($result_project) > 0) {
        $row_project = mysqli_fetch_assoc($result_project);
        $name_project = htmlspecialchars($row_project['name_project']);
        $desc_project = nl2br(htmlspecialchars($row_project['desc_project']));
    } else {
        $name_project = "Project Tidak Ditemukan";
        $desc_project = "Deskripsi tidak tersedia.";
    }
    ?>
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
                        <div class="card-header">
                            <h5 class="card-title">Create New Task</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-link"></a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Contributors</h5>
                            <div class="card-tools">
                                <?php include "style/template/new_contributors.php"; ?>

                            </div>
                        </div>
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