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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Folders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
                    <a href="#" class="nav-link">
                      <i class="fas fa-inbox"></i> Inbox
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
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-file-alt"></i> Invitations
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-filter"></i> Recent
                      <span class="badge bg-warning float-right">65</span>
                    </a>
                  </li>
                </ul>
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
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search Mail" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit" class="btn btn-primary btn-sm ms-1"><i class="fas fa-search"></i></button>
      </form>
    </div>
  <form method="POST" action="config/aksi_notifikasi_massal.php" id="notifForm">
    <div class="table-responsive mailbox-messages">
      <table class="table table-hover table-striped">
        <tbody>
          <?php
          $id_user = $_SESSION["id_user"];
          $search = $_GET['search'] ?? '';
          $searchSql = $search ? "AND message LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'" : '';
          $sql = "SELECT * FROM notification WHERE id_user = '$id_user' $searchSql ORDER BY created_at DESC";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $notif_id = $row['id'];
              $pesan = $row['message'];
              $tanggal = date('d M Y, H:i', strtotime($row['created_at']));
              $type = $row['type'];
              $id_related = $row['id_related'];
              $table_related = $row['table_related'];

              echo "
  <tr>
    <td onclick='event.stopPropagation();'>
      <div class='icheck-primary'>
        <input type='checkbox' name='selected_notif[]' value='$notif_id' id='check$notif_id'>
        <label for='check$notif_id'></label>
      </div>
    </td>
    <td colspan='5' class='notif-row' data-toggle='modal' data-target='#notif$notif_id'>
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
  <div class="card-footer p-0">
    <div class="mailbox-controls d-flex justify-content-between align-items-center px-2">
      <div>
        <button type="button" class="btn btn-default btn-sm checkbox-toggle">
          <i class="far fa-square"></i>
        </button>
        <button type="submit" form="notifForm" name="action" value="delete" class="btn btn-default btn-sm">
          <i class="far fa-trash-alt"></i>
        </button>
        <button type="button" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#modalReadAll">
          <i class="fas fa-envelope-open-text"></i> Read All
        </button>
      </div>
    </div>
  </div>          
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
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p id="deleteMessage">?</p>
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
      btn.addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('input[name="selected_notif[]"]');
        const allChecked = [...checkboxes].every(cb => cb.checked);
        checkboxes.forEach(cb => cb.checked = !allChecked);
        this.querySelector('i').classList.toggle('fa-square', allChecked);
        this.querySelector('i').classList.toggle('fa-check-square', !allChecked);
      });
    });

    document.querySelectorAll('.notif-row').forEach(row => {
      row.addEventListener('click', function () {
        const notifId = this.dataset.id;

        // Kirim AJAX untuk tandai sebagai dibaca dan ambil jumlah baru
        fetch(`config/mark_read.php?id=${notifId}`)
          .then(response => response.text())
          .then(count => {
            document.getElementById('badge-read-count').textContent = count;
          });
      });
    });

    document.querySelectorAll('.notif-row').forEach(row => {
      row.addEventListener('click', function () {
        const notifId = this.dataset.id;
        fetch(`config/mark_read.php?id=${notifId}`);
      });
    });


    document.getElementById('btnDeleteSelected').addEventListener('click', function () {
      const checkboxes = document.querySelectorAll('input[name="selected_notif[]"]:checked');
      const ids = [...checkboxes].map(cb => cb.value);
      const count = ids.length;

      document.getElementById('deleteMessage').innerHTML = `Are you sure you want to delete <strong>${count}</strong> selected notification${count > 1 ? 's' : ''}?`;
      document.getElementById('selectedNotifIds').value = ids.join(',');
    });
    </script>