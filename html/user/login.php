<div class="container">
  <?php if(isset($_GET['message'])) { ?> 
          <p><h4 style="color: red; "><?= $_GET['message'] ?> </h4></p>
  <?php } ?> 
  <div class="container">
    <form action="index.php?action=authentified" method="POST">
      <h3>Login</h3><br>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <a href="index.php?action=email_check">Forget Password</a>
    </form>
  </div>
</div>