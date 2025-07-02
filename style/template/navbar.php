<!-- Shouldn't The Entire Page Called sidebar.php for relevancy ?  -->
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li>
      <?php
      if (isset($_SESSION['level'])) {
        echo '<a class="btn btn-danger" href="logout.php">Keluar</a>';
      } else {
        include("login.php");
      }
      ?>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <!-- Note: Untuk dimasukan logo dari asset/img/logo_white_2.webp kesini  -->
    <img src="asset/img/logo_white_1.webp" alt="Tasklyze Logo" class="brand-image" >
    <span class="brand-text font-weight-bold text-center">Tasklyze</span>
  </a>

<?php
$currentPage = $_GET['page'] ?? '';
?>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image d-flex align-items-center justify-content-center pl-3">
        <i class="fa-solid fa-circle-user fa-xl" style="color: #f6f9fe;"></i>
      </div>
      <div class="info">
        <a href="" class="d-block"> <?php echo $_SESSION['username']; ?></a>
      </div>
    </div>


    <!-- Sidebar Menu --> 
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <!-- Dashboard, Took me a while to figure out >x<, 
         Note to everyone: blom ada kondisi ketika highlight aktif -->
        <li class="nav-item">
            <a href="?page=dashboard" class="nav-link <?= ($currentPage === '' or $currentPage === 'dashboard') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <!-- Projects -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link <?= ($currentPage === 'project' or $currentPage === 'new_project') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Projects
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

<?php
$sql = "SELECT * FROM r_user_project 
  LEFT JOIN user ON r_user_project.id_user = user.id_user 
  LEFT JOIN project ON r_user_project.id_project = project.id_project 
  WHERE user.id_user = '" . $_SESSION['id_user'] . "'";
$res = mysqli_query($conn, $sql);

$currentProjectId = $_GET['id'] ?? null;

if (mysqli_num_rows($res) > 0) {
  while ($data = mysqli_fetch_array($res)) {
    $isActive = ($currentProjectId == $data['id_project']) ? 'active' : '';
    ?>
    <li class="nav-item">
      <a href="index.php?page=project&&id=<?php echo $data['id_project']; ?>" class="pl-4 nav-link overflow-hidden <?= $isActive ?>">
        <i class="far fa-circle nav-icon"></i>
        <p class="p fs-5 text-truncate mb-0"><?php echo $data['name_project']; ?></p>
      </a>
    </li>
  <?php }
} else {
  echo '<p class="pb-1 text-center text-warning fw-bold">You don\'t have any project yet!</p>';
}
?>
            <li class="nav-item">
              <a class="nav-link <?= ($currentPage === 'new_project') ? 'active' : ''; ?>" href="?page=new_project ">
                <i class="far fa-plus nav-icon"></i>
                <p>Create New Project</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="?page=mailbox" class="nav-link <?= ($currentPage === 'mailbox') ? 'active' : ''; ?>">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Mailbox
            </p>
                                  <?php
                      $id_user = $_SESSION['id_user'];
                      $q_read = mysqli_query($conn, "SELECT COUNT(*) AS total_read FROM notification WHERE id_user = '$id_user' AND is_read = 0");
                      $data_read = mysqli_fetch_assoc($q_read);
                      $total_read = $data_read['total_read'];
                      if ($total_read > 0): ?>
                        <span id="badge-read-count" class="badge bg-primary float-right"><?= $total_read ?></span>
                      <?php endif; ?>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>