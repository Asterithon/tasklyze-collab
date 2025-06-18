<div class="card card-primary card-outline">
  <?php
    $sql = "SELECT * FROM task";
    $res = mysqli_query($conn, $sql);

    while ($data = mysqli_fetch_array($res)) { ?>
      <div class="card-header">
        <div class="card-tools">
          <input type="checkbox" name="status" id="status" value="done">
        </div>
        <h5 class="card-title"><?php echo $data['name_task']; ?></h5>
      </div>
  <?php } ?>
</div>
