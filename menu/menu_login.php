<nav class="navbar navbar-default">
  <div class="container-fluid">
  	<div class="navbar-header">
      <a class="navbar-brand" href="index.php">Education Department</a>
    </div>
    <ul class="nav navbar-nav" style=" float: right">
		<li>
			<?php if ( isset($_SESSION["user"]) && $_SESSION["user"] !== "" ) { ?>
				<a href="index.php?action=user_edit&id=<?= $_SESSION["user"]["id"] ?>">
					<img class="profilePhoto" src="<?= $_SESSION["user"]["photo"] !=="" ? $_SESSION["user"]["photo"] :"uploads/default.jpg" ?>" > <b style="color: #483D8B "><?= ucfirst($_SESSION["user"]["firstName"])." ".ucfirst($_SESSION["user"]["lastName"]); ?></b>
				</a>
			 <?php }else{ ?>
			 	<a href="index.php?action=login">Login</a>
			 <?php } ?>
		</li>
		<?php 
		if ( isset($_SESSION["user"]) && $_SESSION["user"] !== "" ) { ?>
			<li><br><a href="index.php?action=logout">Logout</a></li>
  <?php }else {?>
			<li><a href="index.php?action=signup">Signup</a></li>
  <?php } ?>
    </ul>
  </div>
</nav>


