<?php require_once "menu/menu_action.php"; ?>
<div class="container">
  <h2>Students List</h2>
  <p><h3>Information for all students:</h3></p> 
  <form action="index.php?action=student_list" method="POST">
    <div class="form-group">
      <label>Sort by</label>
      <select class="form-control" name="sort">
        <option value="">---</option>
        <option value="firstName" <?= (isset($sort) && $sort == "firstName")?"selected":"" ?> >First Name</option>
        <option value="lastName" <?= (isset($sort) && $sort == "lastName")?"selected":"" ?>>Last Name</option>
      </select>
    </div>
    <div class="form-group">
      <label>Order by</label>
      <select class="form-control" name="order">
        <option value="">---</option>
        <option value="asc" <?= (isset($order) && $order == "asc")?"selected":"" ?>>Ascending</option>
        <option value="desc" <?= (isset($order) && $order == "desc")?"selected":"" ?>>Descending</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form> 
  <form action="index.php?action=delete_selected" method="POST" class="delete-form">    
    <table class="table">
      <thead>
        <tr>
          <th>Row</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($students as $key => $value) { ?>
        <tr>
          <td><input type="checkbox"  name="row[]" value=<?= $value["id_student"] ?>></td>
          <td><?= $value["firstName"] ?></td>
          <td><?= $value["lastName"] ?></td>
          <td><?= $value["email"] ?></td>
          <td><a href="index.php?action=student_detail&id=<?= $value["id_student"] ?>" class="detail" data-id="<?= $value["id_student"] ?>">
                <i class="fas fa-info-circle"></i>
              </a> | 
              <a href="index.php?action=student_edit&id=<?= $value["id_student"] ?>" class="modify" data-id="<?= $value["id_student"] ?>">
                <i class="fas fa-edit"></i>
              </a> | 
              <a href="index.php?action=student_delete&id=<?= $value["id_student"] ?>" class="delete">
                <i class="fas fa-trash-alt"></i>
              </a>
          </td>      
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
</div>