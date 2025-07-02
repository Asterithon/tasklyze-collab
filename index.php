<?php
include("inc/connec.php");
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int) $_GET['id'] : null;
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="asset/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="asset/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="asset/favicon/favicon-16x16.png">
  <link rel="manifest" href="asset/favicon/site.webmanifest">
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
<style>
  .task-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
  gap: 1rem;
  justify-content: start;
}
</style>
<body class="hold-transition sidebar-mini layout-fixed">
  <!-- wrapper -->
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
        <img src="asset/img/logo_1.webp" class="img-thumbnail mb-4 border border-0" alt="Logo" style="width: 100px; height: auto;">
  <div class="text-center flex-column justify-content-center">
    <div class="spinner-border text-primary mr-3" role="status"></div>
    <p class="h4 text-primary">Please Wait...</p>
  </div>
    </div> -->


    <!-- Navbar -->
    <?php
    if(isset($_SESSION['id_user'])) {
        include 'style/template/navbar.php';
        if (isset($_GET['page'])) {
          $page = $_GET['page'];
          // add new page here
          // Cleanup biar urut, Notice org bakal bingung naruh page di template/style, dua kombinasi direktori yg linglung >x<
          switch ($page) {
            case 'dashboard';
              include 'style/template/dashboard.php';
              break;
            case 'project';
              include 'project.php';
              break;
            case 'new_project';
              include 'style/template/new_project.php';
              break;
            case 'mailbox';
              include 'style/template/mailbox.php';
              break;
            default:
              include '404.php';
              break;
          }
        } else {
          include 'style/template/dashboard.php';
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