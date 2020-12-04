<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
        <?php if( $_GET['action'] == 'student_list' || $_GET['action'] == 'student_detail' || $_GET['action'] == 'student_edit' ) { ?>
     		<li><a href="index.php?action=student_add">Add</a></li>
        <?php }elseif( $_GET['action'] == 'course_list' || $_GET['action'] == 'course_detail' || $_GET['action'] == 'course_edit') {?>
       		<li><a href="index.php?action=course_add">Add</a></li>
        <?php }?>

        <li><a href="#" class="delete-selected">Delete</a></li>
    </ul>
  </div>
</nav>