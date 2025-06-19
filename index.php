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
    if(isset($_SESSION['id_user'])) {
        include 'style/template/header.php';
        if (isset($_GET['page'])) {
          $page = $_GET['page'];

          // add new page here 
          switch ($page) {
            case 'mailbox';
              include 'style/template/mailbox.php';
              break;
            case 'project';
              include 'project.php';
              break;
            default:
              include '404.php';
              break;
          }
        } else {
          include 'dashboard.php';
        }
      } else {
        include 'landing_page.php';}
      
    ?>
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