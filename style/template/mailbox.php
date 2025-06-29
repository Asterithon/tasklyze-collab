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
                    <span class="badge bg-primary float-right">12</span>
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

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-share"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i>
                </button>
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-right"></i>
                    </button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php
                    $id_user = $_SESSION["id_user"];
                    $sql = "SELECT * FROM notification WHERE id_user = '$id_user' ORDER BY created_at DESC";
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
      <input type='checkbox' value='$notif_id' id='check$notif_id'>
      <label for='check$notif_id'></label>
    </div>
  </td>

  <td colspan='5' class='notif-row'
      data-toggle='modal'
      data-target='#notif$notif_id'
      data-id='$notif_id'
      data-type='$type'
      data-message='" . htmlspecialchars($pesan, ENT_QUOTES) . "'
      data-date='$tanggal'
      data-idrelated='$id_related'
      data-tablerelated='$table_related'>
    
    <div class='d-flex'>
      <div class='mailbox-name mr-3'>
        <a href='#'>$type</a>
      </div>
      <div class='mailbox-subject flex-grow-1'>
        - $pesan
      </div>
      <div class='mailbox-attachment'></div>
      <div class='mailbox-date text-nowrap'>$tanggal</div>
    </div>
  </td>
</tr>"; include "style/template/modal_mailbox.php";
                      }
                    } else {
                      echo "
    <tr>
        <td colspan='6' class='text-center text-muted'>
            📭 Kamu belum punya pesan saat ini.
        </td>
    </tr>";
                    }
                    ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-share"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i>
                </button>
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-chevron-right"></i>
                    </button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
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

  <!-- Page specific script -->
  <script>
    document.querySelectorAll('.notif-row').forEach(row => {
      row.addEventListener('click', function() {
        const type = this.dataset.type;
        const message = this.dataset.message;
        const date = this.dataset.date;
        const idRelated = this.dataset.idrelated;

        document.getElementById('modalNotifTitle').textContent = type.charAt(0).toUpperCase() + type.slice(1);
        document.getElementById('modalNotifMessage').textContent = `${message}`;
        document.getElementById('modalNotifDate').textContent = `${date}`;

        // Handle tombol invitation
        if (type === 'invitation') {
          document.getElementById('invitationActions').classList.remove('d-none');
          document.getElementById('inputInvitationId').value = idRelated;
          document.getElementById('inputInvitationIdDecline').value = idRelated;
        } else {
          document.getElementById('invitationActions').classList.add('d-none');
        }
      });
    });

    $(function() {
      //Enable check and uncheck all functionality
      $('.checkbox-toggle').click(function() {
        var clicks = $(this).data('clicks')
        if (clicks) {
          //Uncheck all checkboxes
          $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
          $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
          //Check all checkboxes
          $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
          $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
      })

      //Handle starring for font awesome
      $('.mailbox-star').click(function(e) {
        e.preventDefault()
        //detect type
        var $this = $(this).find('a > i')
        var fa = $this.hasClass('fa')

        //Switch states
        if (fa) {
          $this.toggleClass('fa-star')
          $this.toggleClass('fa-star-o')
        }
      })
    })
  </script>