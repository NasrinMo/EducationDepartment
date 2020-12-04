<div class="container">
  <?php if(isset($_GET['message'])) { ?> 
      <p><h4 style="color: red"><?= $_GET['message'] ?> </h4></p>
    <?php } ?>
  <div class="container">
    <form action="index.php?action=sendLink" method="POST">
      <input type="hidden" value="<?= $user["id"] ?>" name="id" >
      <div class="form-group">
        <label for="email">Enter the email address you used when creating the account and click Send Password Reset</label>
        <input type="text" class="form-control" value="" name="email" >
      </div> 
      <a href="index.php?action=login" class="btn btn-primary" >Go back</a> 
      <button type="submit" class="btn btn-primary">Send Password Reset</button>
    </form>
  </div>
</div>