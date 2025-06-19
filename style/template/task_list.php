  <?php
    $sql = "SELECT * FROM task";
    $res = mysqli_query($conn, $sql);

    while ($data = mysqli_fetch_array($res)) { ?>
      <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title"><?php echo $data['name_task']; ?></h5>
          <div class="card-tools mr-0 form-check">
            <input type="checkbox" name="status" id="status" value="done">
          </div>
        </div>
        <div class="card-body">
          <p><?php echo $data['desc_task'];?></p>
        </div>
    </div>
  <?php } ?>
