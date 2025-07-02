    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Inbox</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Inbox</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-3">
            <a href="" class="btn btn-primary btn-block mb-3">refresh</a>

            <div class="card " >
              <div class="card-header"data-card-widget="collapse">
                <h3 class="card-title fw-bold">Folders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
<?php
$id_user = $_SESSION['id_user'];

// Ambil total notifikasi belum dibaca per type
$qNotif = mysqli_query($conn, "
  SELECT type, COUNT(*) AS total 
  FROM notification 
  WHERE id_user = '$id_user' 
  GROUP BY type
");

$notifCounts = [
  'all' => 0,
  'task' => 0,
  'task update' => 0,
  'invitation' => 0,
  'project' => 0,
  'reminder' => 0
];

while ($row = mysqli_fetch_assoc($qNotif)) {
  $type = strtolower($row['type']);
  $count = (int)$row['total'];
  if (isset($notifCounts[$type])) {
    $notifCounts[$type] = $count;
  }
  $notifCounts['all'] += $count;
}$activeType = $_GET['type'] ?? 'all';
?>

<li class="nav-item">
  <a href="?page=mailbox&type=all" class="nav-link <?= $activeType === 'all' ? 'active bg-primary bg-gradient' : '' ?>">
    <i class="fas fa-inbox"></i> All
    <?php if ($notifCounts['all'] > 0): ?>
      <span class=" float-right"><?= $notifCounts['all'] ?></span>
    <?php endif; ?>
  </a>
</li>

<li class="nav-item">
  <a href="?page=mailbox&type=task" class="nav-link <?= $activeType === 'task' ? 'active' : '' ?>">
    <i class="fas fa-tasks"></i> Task
    <?php if ($notifCounts['task'] > 0): ?>
      <span class=" float-right"><?= $notifCounts['task'] ?></span>
    <?php endif; ?>
  </a>
</li>

<li class="nav-item">
  <a href="?page=mailbox&type=task update" class="nav-link <?= $activeType === 'task update' ? 'active' : '' ?>">
    <i class="fas fa-sync-alt"></i> Task Update
    <?php if ($notifCounts['task update'] > 0): ?>
      <span class=" float-right"><?= $notifCounts['task update'] ?></span>
    <?php endif; ?>
  </a>
</li>

<li class="nav-item">
  <a href="?page=mailbox&type=invitation" class="nav-link <?= $activeType === 'invitation' ? 'active' : '' ?>">
    <i class="far fa-file-alt"></i> Invitation
    <?php if ($notifCounts['invitation'] > 0): ?>
      <span class=" float-right"><?= $notifCounts['invitation'] ?></span>
    <?php endif; ?>
  </a>
</li>

<li class="nav-item">
  <a href="?page=mailbox&type=project" class="nav-link <?= $activeType === 'project' ? 'active' : '' ?>">
    <i class="fas fa-folder-open"></i> Project
    <?php if ($notifCounts['project'] > 0): ?>
      <span class=" float-right"><?= $notifCounts['project'] ?></span>
    <?php endif; ?>
  </a>
</li>

<li class="nav-item">
  <a href="?page=mailbox&type=reminder" class="nav-link <?= $activeType === 'reminder' ? 'active' : '' ?>">
    <i class="fas fa-bell"></i> Reminder
    <?php if ($notifCounts['reminder'] > 0): ?>
      <span class=" float-right"><?= $notifCounts['reminder'] ?></span>
    <?php endif; ?>
  </a>
</li>                </ul>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Inbox</h3>

                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="mailbox-controls d-flex justify-content-between align-items-center px-2">
                  <div>
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                      <i class="far fa-square"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm" id="btnDeleteSelected" data-bs-toggle="modal" data-bs-target="#modalConfirmDelete">
                      <i class="far fa-trash-alt"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#modalReadAll">
                      <i class="fas fa-envelope-open-text"></i> Read All
                    </button>
                  </div>
<form method="GET" class="d-flex">
  <input type="hidden" name="page" value="mailbox">
  <input type="hidden" name="type" value="<?= htmlspecialchars($_GET['type'] ?? 'all') ?>">
  <input type="text" name="search" class="form-control form-control-sm" placeholder="Search Mail" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
  <button type="submit" class="btn btn-primary btn-sm ms-1">
    <i class="fas fa-search"></i>
  </button>
</form>
                </div>
                <form method="POST" action="config/aksi_notifikasi_massal.php" id="notifForm">
                  <div class="table-responsive mailbox-messages overflow-auto">
                    <table class="table table-hover table-striped">
                      <tbody>
<?php
$id_user = $_SESSION["id_user"];
$search = $_GET['search'] ?? '';
$type = $_GET['type'] ?? 'all';

// Filter pencarian
$searchSql = $search ? "AND message LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'" : '';

// Filter tipe notifikasi
$typeSql = ($type !== 'all') ? "AND type = '" . mysqli_real_escape_string($conn, $type) . "'" : '';

// Gabungkan query
$sql = "
  SELECT * FROM notification 
  WHERE id_user = '$id_user' 
  $typeSql 
  $searchSql 
  ORDER BY created_at DESC
";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $notif_id = $row['id'];
    $pesan = $row['message'];
    $tanggal = date('d M Y, H:i', strtotime($row['created_at']));
    $type = $row['type'];
    $id_related = $row['id_related'];
    $table_related = $row['table_related'];

    // Tampilkan notifikasi seperti biasa

                            echo "
    <tr>
      <td onclick='event.stopPropagation();'>
        <div class='icheck-primary'>
          <input type='checkbox' name='selected_notif[]' value='$notif_id' id='check$notif_id'>
          <label for='check$notif_id'></label>
        </div>
      </td>
      <td colspan='5' class='notif-row'
          data-id='$notif_id'
          data-type='$type'
          data-message='" . htmlspecialchars($pesan, ENT_QUOTES) . "'
          data-date='$tanggal'
          data-idrelated='$id_related'
          data-tablerelated='$table_related'
          data-toggle='modal'
          data-target='#notif$notif_id'>
        <div class='d-flex'>
          <div class='mailbox-name mr-3'><a href='#'>$type</a></div>
          <div class='mailbox-subject flex-grow-1'>- $pesan</div>
          <div class='mailbox-date text-nowrap'>$tanggal</div>
        </div>
      </td>
    </tr>";

                            include "style/template/modal_mailbox.php";
                          }
                        } else {
                          echo "  
            <div class='d-flex justify-content-center align-items-center text-center' style='height: 300px; width: 100%;'>
              <div>
                <i class='fas fa-envelope-open-text fa-3x text-muted mb-3'></i>
                <h5 class='text-muted'>No Mail found</h5>
                <p class='text-muted'>Try changing the filter or <a href='?page=mailbox'>reload this page</a>.</p>
              </div>
            </div>";
                        }

                        ?>
                      </tbody>
                    </table>
                  </div>
                </form>
                <!-- /.mail-box-messages -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <div class="modal fade" id="modalReadAll" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="config/aksi_notifikasi_massal.php">
          <input type="hidden" name="action" value="read_all">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Mark All as Read</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
              <p>Are you sure you want to mark all your notifications as <strong>read</strong>?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Yes, Mark All</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="modalConfirmDelete" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="config/aksi_notifikasi_massal.php" id="deleteNotifForm">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="selected_ids" id="selectedNotifIds">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirm Deletion</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <p id="deleteMessage"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- Page specific script -->
    <script>
      document.querySelectorAll('.checkbox-toggle').forEach(btn => {
        btn.addEventListener('click', function() {
          const checkboxes = document.querySelectorAll('input[name="selected_notif[]"]');
          const allChecked = [...checkboxes].every(cb => cb.checked);
          checkboxes.forEach(cb => cb.checked = !allChecked);
          this.querySelector('i').classList.toggle('fa-square', allChecked);
          this.querySelector('i').classList.toggle('fa-check-square', !allChecked);
        });
      });

      document.querySelectorAll('.notif-row').forEach(row => {
        row.addEventListener('click', function() {
          const notifId = this.dataset.id;

          // Kirim AJAX untuk tandai sebagai dibaca dan ambil jumlah baru
          fetch(`config/mark_read.php?id=${notifId}`)
            .then(response => response.text())
            .then(count => {
              const badge = document.getElementById('badge-read-count');
              if (badge) {
                if (parseInt(count) > 0) {
                  badge.textContent = count;
                  badge.style.display = 'inline-block';
                } else {
                  badge.style.display = 'none';
                }
              }
            });
        });
      });


      document.getElementById('btnDeleteSelected').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="selected_notif[]"]:checked');
        const ids = [...checkboxes].map(cb => cb.value);
        const count = ids.length;

        document.getElementById('deleteMessage').innerHTML = `Are you sure you want to delete <strong>${count}</strong> selected notification${count > 1 ? 's' : ''}?`;
        document.getElementById('selectedNotifIds').value = ids.join(',');
      });
    </script>