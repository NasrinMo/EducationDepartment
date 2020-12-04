<?php require_once "menu/menu_action.php"; ?>
<div class="container">
  <p><h2>Information for <?= $student["firstName"]." ".$student["lastName"] ?> :</h2></p>            
  <table class="table">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birthday</th>
         <th>Gender</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $student["firstName"] ?></td>
        <td><?= $student["lastName"] ?></td>
        <td><?= $student["birthday"] ?></td>
        <?php if( $student["gender"] == "m" ) { ?>
          <td>Male</td>
        <?php } else { ?>
          <td>Female</td>
        <?php }  ?>
        <td><?= $student["email"] ?></td> 
        <td><?= $student["phone"] ?></td> 
        <td><a href="index.php?action=student_edit&id=<?= $student["id_student"] ?>" class="modify" data-id="<?= $student["id_student"] ?>">
              <i class="fas fa-edit"></i>
            </a> | 
            <a href="index.php?action=student_delete&id=<?= $student["id_student"] ?>" class="delete">
              <i class="fas fa-trash-alt"></i>
            </a>
        </td>      
      </tr>
    </tbody>
  </table>

   <h3>Courses</h3>
   <div class="box">
      <?php if(isset($student["courses"])){ ?>
              <ul>
             <?php foreach ($student["courses"] as $key => $value) { ?>
                <li><?= $value['title']."  (Unit:".$value['unit'].")" ?></li>
             <?php  } ?>
             </ul>
      <?php }else{ ?>
              <h5 style="color: gray">Not selected yet</h5>
      <?php }?>
  </div>
  <hr>

  <h3>Tags</h3>
  <div class="box">
    <?php if(isset($student["tags"])){ ?>
            <ul>
           <?php foreach ($student["tags"] as $key => $value) { ?>
              <li><?= $value['name'] ?></li>
           <?php  } ?>
           </ul>
    <?php }else{ ?>
            <h5 style="color: gray">Empty</h5>
    <?php }?>
  </div>
  <br><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Go back</a> 
</div>