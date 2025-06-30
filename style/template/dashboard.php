<!-- Content Wrapper. Contains page content. Nyolong mailbox.php -->
<div class="content-wrapper">
  <!-- Content Header (Page header) Apparently this content-header and container-fluid makes the differences with how the sidebar -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
    $uid = $_SESSION['id_user'];
    $username = $_SESSION['username'];

    $project_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM r_user_project WHERE id_user = $uid");
    $project_total = mysqli_fetch_assoc($project_q)['total'];

    $task_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM r_user_task WHERE id_user = $uid");
    $task_total = mysqli_fetch_assoc($task_q)['total'];

    $inv_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM invitation WHERE id_receiver = $uid AND status = 'pending'");
    $inv_total = mysqli_fetch_assoc($inv_q)['total'];

    $notif_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM notification WHERE id_user = $uid AND is_read = 0");
    $notif_total = mysqli_fetch_assoc($notif_q)['total'];

    $projects = mysqli_query($conn, "
      SELECT p.id_project, p.name_project 
      FROM r_user_project rup 
      JOIN project p ON rup.id_project = p.id_project 
      WHERE rup.id_user = $uid
    ");

    $progress_data = [];
    $tasks = mysqli_query($conn, "
      SELECT t.name_task, rt.status
      FROM r_user_task rt
      JOIN task t ON rt.id_task = t.id_task
      WHERE rt.id_user = $uid
    ");

    while ($row = mysqli_fetch_assoc($tasks)) {
      $progress_data[] = [
        'name' => $row['name_task'],
        'status' => $row['status']
      ];
    }
    ?>

    <div class="row">
      <div class="col-md-3">
        <div class="info-box bg-info">
          <span class="info-box-icon"><i class="fas fa-folder-open"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">My Projects</span>
            <span class="info-box-number"><?= $project_total ?></span>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box bg-success">
          <span class="info-box-icon"><i class="fas fa-tasks"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">My Tasks</span>
            <span class="info-box-number"><?= $task_total ?></span>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box bg-warning">
          <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Pending Invites</span>
            <span class="info-box-number"><?= $inv_total ?></span>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="info-box bg-danger">
          <span class="info-box-icon"><i class="fas fa-bell"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Unread Notifications</span>
            <span class="info-box-number"><?= $notif_total ?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Daftar Proyek -->
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Proyek</h5>
          </div>
          <ul class="list-group list-group-flush">
            <?php if (mysqli_num_rows($projects) > 0): ?>
              <?php while ($p = mysqli_fetch_assoc($projects)): ?>
                <li class="list-group-item"><?= htmlspecialchars($p['name_project']) ?></li>
              <?php endwhile; ?>
            <?php else: ?>
              <li class="list-group-item text-muted">Belum ada proyek.</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <!-- Progress Tugas -->
      <div class="col-md-7 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-success text-white">
            <h5 class="mb-0">Progress Tugas</h5>
          </div>
          <div class="card-body">
            <?php if (!empty($progress_data)): ?>
              <?php foreach ($progress_data as $p): ?>
                <p class="mb-1"><?= htmlspecialchars($p['name']) ?></p>
                <div class="alert alert-<?= $p['status'] === 'done' ? 'success' : 'warning' ?>" role="alert">
                  Status: <?= htmlspecialchars($p['status']) ?>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="text-muted">Belum ada tugas yang tercatat.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>