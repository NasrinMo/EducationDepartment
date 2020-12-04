<?php require_once "menu/menu_action.php"; ?>
<div class="container">
  <?php if(isset($_GET['error'])) { ?> 
      <p><h4 style="color: red"><?= $_GET['error'] ?> </h4></p>
  <?php } ?>
    <form action="index.php?action=course_update" method="post">
      <input type="hidden" name="id" value="<?= $course["id_course"] ?>" >
      <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" name="title" value="<?= $course['title'] ?>" >
      </div>
      <div class="form-group">
        <label>Unit</label>
        <input type="text" class="form-control" name="unit" value="<?= $course['unit'] ?>">
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="5" name="description"><?= $course['description'] ?></textarea>
      </div>

      <div class="form-group">
      <label>Selected Students</label><br>
      <div class="box">
        <?php if (isset($allStudents)) {
                  foreach ($allStudents as $key => $value) {  ?>
                    <input type="checkbox" name="students[]" value="<?= $value["id_student"] ?>" <?= isset( $course['students'][$value["id_student"]])?"checked" : "" ?> >
                    <label><?= $value['firstName']." ".$value['lastName']  ?></label>
                    <br>
            <?php }
              } ?>
      </div>
    </div>

      <button type="submit" class="btn btn-primary">Submit</button>
      <button  class="btn btn-primary">Cancel</button>
    </form>
</div>
