<?php
include("inc/connec.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tasklyze</title>
  <contain-style>
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Font Awesome 6.7.2 via CDNJS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="style/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="style/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="style/css/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="style/css/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="style/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="style/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="style/css/daterangepicker.css">
  </contain-style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- wrapper -->
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php
    include 'style/template/header.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
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
                <!-- modal -->
                <?php
                    if (isset($_SESSION['level'])) {
                      echo '<a class="btn btn-danger" href="logout.php">Keluar</a>';
                      if ($_SESSION['level'] == "user") {
                        echo '<a class="btn btn-primary" href="kanban.php?id=' . $_GET['id'] . '">Back to Project</a>';}
                      
                    } else {
                      include("login.php");
                    }

                ?>
                <!-- /Modal -->
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
                    <a href="#" class="btn btn-tool">
                      <i class="fas fa-pen"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" disabled>
                    <label for="customCheckbox1" class="custom-control-label">Bug</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled>
                    <label for="customCheckbox2" class="custom-control-label">Feature</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                    <label for="customCheckbox3" class="custom-control-label">Enhancement</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" disabled>
                    <label for="customCheckbox4" class="custom-control-label">Documentation</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox5" disabled>
                    <label for="customCheckbox5" class="custom-control-label">Examples</label>
                  </div>
                </div>
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

          <div class="card card-row card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Backlog
              </h3>
            </div>
            <div class="card-body">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <h5 class="card-title">Create Labels</h5>
                  <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-link">#3</a>
                    <a href="#" class="btn btn-tool">
                      <i class="fas fa-pen"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" disabled>
                    <label for="customCheckbox1" class="custom-control-label">Bug</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled>
                    <label for="customCheckbox2" class="custom-control-label">Feature</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                    <label for="customCheckbox3" class="custom-control-label">Enhancement</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" disabled>
                    <label for="customCheckbox4" class="custom-control-label">Documentation</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox5" disabled>
                    <label for="customCheckbox5" class="custom-control-label">Examples</label>
                  </div>
                </div>
              </div>
              
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title">Create Issue template</h5>
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
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title">Create PR template</h5>
                  <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-link">#6</a>
                    <a href="#" class="btn btn-tool">
                      <i class="fas fa-pen"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card card-light card-outline">
                <div class="card-header">
                  <h5 class="card-title">Create Actions</h5>
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
            </div>
          </div>

          <div class="card card-row card-primary">
            <div class="card-header">
              <h3 class="card-title">
                To Do
              </h3>
            </div>
            <div class="card-body">
              <?php include ("style/template/task_list.php"); ?>
            </div>
              <button type="button" class="card card-primary card-outline" data-bs-toggle="modal" data-bs-target="#newTask">
                <div class="card-header">
                  <h5 class="card-title">Create new task</h5>
                  <div class="card-tools">
                    <a href="#" class="btn btn-tool">
                      <i class="fas fa-pen"></i>
                    </a>
                  </div>
                </div>
              </button>
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
    <!-- /.content-wrapper -->


  </div>
  <!-- ./wrapper -->

  <!-- Footer -->
  <?php
  include 'style/template/footer.php';
  ?>

  <!-- jQuery -->
  <contain-query>
    <script src="style/js/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="style/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="js/scripts.js"></script>
    <!-- Bootstrap 4 -->
    <script src="style/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="style/js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="style/js/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="style/js/jquery.vmap.min.js"></script>
    <script src="style/js/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="style/js/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="style/js/moment.min.js"></script>
    <script src="style/js/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="style/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="style/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="style/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="style/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="style/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </contain-query>
</body>

</html>