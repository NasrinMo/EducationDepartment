<div class="container">
  <?php if(isset($_GET['error'])) { ?> 
      <p><h4 style="color: red"><?= $_GET['error'] ?> </h4></p>
    <?php } ?> 
  <form action="index.php?action=student_insert" method="post">
    <div class="form-group">
      <label>First Name</label>
      <input type="text" class="form-control" name="firstName" >
    </div>
    <div class="form-group">
      <label>Last Name</label>
      <input type="text" class="form-control" name="lastName" >
    </div>
    <div class="form-group">
      <label>Birthday</label>
      <input type="date" class="form-control"  name="birthday" >
    </div>
    <div class="form-group">
    <div class="form-group">
      <label>Gender</label>
      <select class="form-control" name="gender">
        <option value="m">Male</option>
        <option value="f">Female</option>
      </select>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="text" class="form-control" name="email" >
    </div>
    <div class="form-group">
      <label>Phone</label>
      <input type="text" class="form-control" name="phone" >
    </div>
    <div class="form-group">
      <label>Tags</label>
      <textarea class="form-control" rows="2" name="tags" placeholder="Separation by comma ','"></textarea>
    </div>
    <div class="form-group">
      <label>Select Courses</label><br>
      <div class="box">
        <?php if (isset($allCourses)) {
                  foreach ($allCourses as $key => $value) {  ?>
                    <input type="checkbox" name="courses[]" value="<?= $value["id_course"] ?>">
                    <label><?= $value["title"] ?></label>
                    <br>
            <?php }
              } ?>
      </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
