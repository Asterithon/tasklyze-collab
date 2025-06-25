  <?php
    include ("inc/connec.php");
    $sql = "SELECT * FROM task where id_project = '" . $_GET['id'] . "'";
    $res = mysqli_query($conn, $sql);

    while ($data = mysqli_fetch_array($res)) { ?>
      <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title text-truncate mw-100 text-nowrap"><?php echo $data['name_task']; ?></h5>
          <div class="card-tools mr-0 form-check">
            <input type="checkbox" name="status" id="status" value="done">
          </div>
        </div>
        <div class="card-body">
          <p><?php echo $data['desc_task'];?></p>
          <p class="text-secondary"><?php echo $data['created_at'];?></p>
        </div>
    </div>
  <?php } ?>
