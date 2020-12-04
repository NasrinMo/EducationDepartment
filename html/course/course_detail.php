
<?php require_once "menu/menu_action.php"; ?>
<div class="container">
  <?php if(isset($_GET['error'])) { ?> 
       <span><h4 style='color:red'><?= $_GET['error'] ?> </h4></span>
  <?php } ?>
  <p><h2>Information for <?= $course["title"] ?> :</h2></p> 
  <br>          
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Unit</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <td><?= $course["title"] ?></td>
        <td><?= $course["unit"] ?></td>
        <td><?= $course["description"] ?></td>  
        <td><a href="index.php?action=course_edit&id=<?= $course["id_course"] ?>" class="modify" data-id="<?= $course["id_course"] ?>">
              <i class="fas fa-edit"></i>
            </a> | 
            <a href="index.php?action=course_delete&id=<?= $course["id_course"] ?>" class="delete">
              <i class="fas fa-trash-alt"></i>
            </a>
        </td>  
      </tr>
    </tbody>
  </table>
  <br>
  <h3>Related Students</h3>
  <div class="box">
  <?php if(isset($course["students"])){ ?>
          <ul>
         <?php foreach ($course["students"] as $key => $value) { ?>
            <li><?= $value['firstName']." ".$value['lastName']  ?></li>
         <?php  } ?>
         </ul>
  <?php }else{ ?>
          <h5 style="color: gray">Not selected yet</h5>
  <?php }?>
  </div>
  <br><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Go back</a> 
</div>
