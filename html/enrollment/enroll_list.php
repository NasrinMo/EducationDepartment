

<div class="container">
  <?php if(isset($_GET['error'])) { ?> 
       <span><h4 style='color:red'><?= $_GET['error'] ?> </h4></span>
  <?php } ?> 

  <h2>Enrollment List</h2>
  <p><h3>Enrollment information  for all students:</h3></p>           
  <table class="table">
    <?php  $student="";
    foreach ($enrolls as $key => $value) { ?>
      <thead>
        <tr>
          <?php if( $value["id_student"] !== $student ){ ?>
             <th>Action</th>
             <th>Student Name</th>
             <th>Course Title</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php if( $value["id_student"] !== $student ){ ?>
            <td><a href="index.php?action=student_detail&id=<?= $value["id_student"] ?>" class="detail" data-id="<?= $value["id_course"] ?>">
              <i class="fas fa-info-circle"></i>
            </a> | 
            <a href="index.php?action=student_edit&id=<?= $value["id_student"] ?>" class="modify" data-id="<?= $value["id_course"] ?>">
              <i class="fas fa-edit"></i>
            </a> | 
            <a href="index.php?action=enroll_delete&id=<?= $value["id_student"] ?>" class="delete">
              <i class="fas fa-trash-alt"></i>
            </a>
            </td> 
            <td><?= $value["firstName"]." ".$value["lastName"] ?></td>
            <?php $student = $value["id_student"];  
           }else{ ?>
            <td></td>
            <td></td>
           <?php } ?>
          <td><?= $value["title"] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>