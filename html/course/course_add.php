<div class="container">
  <?php if(isset($_GET['error'])) { ?> 
      <p><h4 style="color: red"><?= $_GET['error'] ?> </h4></p>
    <?php } ?> 
  <form action="index.php?action=course_insert" method="post">
    <div class="form-group">
      <label>Title</label>
      <input type="text" class="form-control" name="title" >
    </div>
    <div class="form-group">
      <label>Unit</label>
      <input type="text" class="form-control" name="unit">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" rows="5" name="description"></textarea>
    </div>

    <div class="form-group">
      <label>Select Students</label><br>
      <div class="box">
        <?php if (isset($allStudents)) {
                  foreach ($allStudents as $key => $value) {  ?>
                    <input type="checkbox" name="students[]" value="<?= $value["id_student"] ?>">
                    <label><?= $value['firstName']." ".$value['lastName']  ?></label>
                    <br>
            <?php }
              } ?>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
