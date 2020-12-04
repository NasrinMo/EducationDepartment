 <div class="container"> 
  <?php if(isset($_GET['message'])) { ?> 
          <p><h4 style="color: red"><?= $_GET['message'] ?> </h4></p>
  <?php } ?>   
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <!-- Sign Up form -->
        <form action="index.php?action=createUser" method="POST" enctype="multipart/form-data" class="Signup">
          <h3>Sign Up Now!!!</h3>
          <div class="form-group">
              <label for="name">Fisrt Name</label>
            <input type="text" class="form-control" placeholder="Fisrt Name" name="firstName" required>
          </div>
          <div class="form-group">
              <label for="name">Last Name</label>
            <input type="text" class="form-control" placeholder="Last Name" name="lastName" required>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
            <input type="text" class="form-control" placeholder="Enter Email" name="email" required>
          </div>      
          <div class="form-group">
              <label for="psw">Password</label>
            <input type="password" class="form-control" placeholder="Enter Password" name="password" required> 
          </div>   
          <div class="form-group">
            <label for="psw-repeat">Repeat Password</label>
            <input type="password" class="form-control" placeholder="Repeat Password" name="psw-repeat" required>
          </div>
          <div class="form-group">
            <label>Profile Photo</label>
            <input type="file" id="photo" name="photo" class="form-control">
            <label for="Profile-pic" class="choose-icon"><i class="fa fa-camera" aria-hidden="true"></i></label>
          </div>
          <div class="form-group">
            <label class="term-policy"><input type="checkbox" name="agree"> By creating an account you agree to our <a href="#">Terms & Privacy</a>.</label>
          </div>
          <button type="submit" value="Upload Image" name="submit" class="btn btn-primary">Signup</button>
          <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
          <hr>
          <div class="form-group">
            <p class="not-yet">Already have an account? <a href="index.php?action=login">Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>