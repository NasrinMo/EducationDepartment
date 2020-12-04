
<?php require_once "menu/menu_action.php"; ?>
<div class="container">
  <?php if(isset($_GET['error'])) { ?> 
       <span><h4 style='color:red'><?= $_GET['error'] ?> </h4></span>
  <?php } ?> 

  <h2>Courses List</h2>
  <p><h3>Information for all courses:</h3></p>           
  <table class="table">
    <thead>
      <tr>
        <th>Row</th>
        <th>Title</th>
        <th>Unit</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($courses as $key => $value) { ?>
      <tr>
        <td><input type="checkbox"  name="row" value=<?= $value["id_course"] ?>></td>
        <td><?= $value["title"] ?></td>
        <td><?= $value["unit"] ?></td> 
        <td><a href="index.php?action=course_detail&id=<?= $value["id_course"] ?>" class="detail" data-id="<?= $value["id_course"] ?>">
              <i class="fas fa-info-circle"></i>
            </a> | 
            <a href="index.php?action=course_edit&id=<?= $value["id_course"] ?>" class="modify" data-id="<?= $value["id_course"] ?>">
              <i class="fas fa-edit"></i>
            </a> | 
            <a href="index.php?action=course_delete&id=<?= $value["id_course"] ?>" class="delete">
              <i class="fas fa-trash-alt"></i>
            </a>
        </td>  
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>