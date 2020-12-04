<?php require_once "menu/menu_action.php"; ?>
<?php
$tagstoShow = "";
if(isset($student["tags"])){
    $strTags = "";
    foreach ($student["tags"] as $key => $value) { 
       $strTags .= $value['name'].",";
    }
   $tagstoShow = rtrim($strTags, ",");
} ?>
<div class="container">
  <?php if(isset($_GET['error'])) { ?> 
      <p><h4 style="color: red"><?= $_GET['error'] ?> </h4></p>
    <?php } ?> 
  <form action="index.php?action=student_update" method="post">
    <input type="hidden" name="id" value="<?= $student['id_student'] ?>" >
    <div class="form-group">
      <label>First Name</label>
      <input type="text" class="form-control" name="firstName" value="<?= $student['firstName'] ?>" >
    </div>
    <div class="form-group">
      <label>Last Name</label>
      <input type="text" class="form-control" name="lastName" value="<?= $student['lastName'] ?>">
    </div>
    <div class="form-group">
      <label>Birthday</label>
      <input type="date" class="form-control"  name="birthday" value="<?= $student['birthday'] ?>" >
    </div>
    <div class="form-group">
    <div class="form-group">
      <label>Gender</label>
      <select class="form-control" name="gender">
        <?php if( $student['gender'] == "m"){ ?>
          <option value="m" selected>Male</option>
          <option value="f">Female</option>
        <?php }elseif( $student['gender'] == "f") { ?>
          <option value="m">Male</option>
          <option value="f" selected>Female</option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="text" class="form-control" name="email" value="<?= $student['email'] ?>">
    </div>
    <div class="form-group">
      <label>Phone</label>
      <input type="text" class="form-control" name="phone" value="<?= $student['phone'] ?>">
    </div>

    <div class="form-group">
      <label>Selected Courses</label><br>
      <div class="box">
        <?php if (isset($allCourses)) {
                  foreach ($allCourses as $key => $value) {  ?>
                    <input type="checkbox" name="courses[]" value="<?= $value["id_course"] ?>" 
                    <?= isset($student["courses"][$value["id_course"]]) ? "checked" : "" ?> >
                    <label><?= $value["title"] ?></label>
                    <br>
            <?php }
              } ?>
      </div>
    </div>

     <div class="form-group">
      <label>Tags</label>
      <textarea class="form-control" rows="2" name="tags" placeholder="Separation by comma ','"><?= $tagstoShow ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    <button  class="btn btn-primary">Cancel</button>
  </form>
</div>