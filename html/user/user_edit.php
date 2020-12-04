 <div class="container"> 
  <?php if(isset($_GET['message'])) { ?> 
          <p><h4 style="color: red"><?= $_GET['message'] ?> </h4></p>
  <?php }  ?>   
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form action="index.php?action=user_update" method="POST" enctype="multipart/form-data" class="Signup">
          <input type="hidden" value="<?= $user["id"] ?>" name="id" >
          <h3>Profile Information</h3>
          <div class="form-group">
              <label for="name">Fisrt Name</label>
            <input type="text" class="form-control" value="<?= $user["firstName"] ?>" name="firstName" required>
          </div>
          <div class="form-group">
              <label for="name">Last Name</label>
            <input type="text" class="form-control" value="<?= $user["lastName"] ?>" name="lastName" required>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
            <input type="text" class="form-control" value="<?= $user["email"] ?>" name="email" required>
          </div>  
          <div class="form-group">
            <label>Profile Photo</label>
            <input type="file" id="Profile-pic" name="photo" class="form-control" >
            <?php if (isset($user["imageUrl"]) && $user["imageUrl"] != "") { ?>
                <img class="profilePhoto" src="<?= $user["imageUrl"] ?>">
            <?php } ?>
            <label for="Profile-pic" class="choose-icon"><i class="fa fa-camera" aria-hidden="true"></i></label>
          </div>
           <a class="btn btn-primary" href="<?= $_SERVER["HTTP_REFERER"] ?>">Cancel</a>
          <button type="submit" value="Upload Image" name="submit" class="btn btn-primary">Submit</button>
          <a href="index.php?action=password_edit&id=<?= $user["id"] ?>">Change Password</a>
        </form>
      </div>
    </div>
  </div>