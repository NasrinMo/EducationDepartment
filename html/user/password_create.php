<div class="container">
  <?php if(isset($_GET['message'])) { ?> 
      <p><h4 style="color: red"><?= $_GET['message'] ?> </h4></p>
    <?php } ?>
  <div class="container">
    <form action="index.php?action=password_update_by_token" method="POST">
      <input type="hidden" value="<?= $user["id"] ?>" name="id" >
      <input type="hidden" value="<?= $user["token"] ?>" name="token" >
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" value="<?= $user["email"] ?>" name="email" readonly>
      </div> 
      <div class="form-group">
        <label for="exampleInputPassword1">New Password</label>
        <input type="password" name="newPassword" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
       <div class="form-group">
        <label for="psw-repeat">Repeat Password</label>
        <input type="password" class="form-control" placeholder="Repeat Password" name="repeatPassword" required>
       </div>
      <a href="index.php?action=login" class="btn btn-primary" >Go back</a> 
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>