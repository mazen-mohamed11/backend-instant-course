<?php
require_once "c:xampp/htdocs/instant course 2/company31/apps/configDB.php";
require_once '../shared/header.php';
require_once '../shared/navbar.php';


if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $selectOne = "SELECT `image` FROM `employees` where id=$id";
  $select = mysqli_query($con,$selectOne);
  $image = mysqli_fetch_assoc($select);
  $location = 'uploads/' . $image['image'];
  $deleteQuery = "DELETE FROM `employees` WHERE id = $id";
  $delete = mysqli_query($con,$deleteQuery);
  if($delete){
    if($image['image']!="fake.webp"){
      unlink($location);
    }
    Path("employees/list.php");
  }
}

$selectQuery = "SELECT * FROM `employeeswithdepartments`";
$select = mysqli_query($con,$selectQuery);
$numOfRows = mysqli_num_rows($select);

?>




<div class="container pt-5">
  <h2 class="text-center text-light">List All Employees : <?= $numOfRows ?></h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>#</th>
            <th>Employee</th>
            <th>email</th>
            <th>department ID</th>
            <th>actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if($numOfRows > 0):?>
            <?php foreach($select as $index => $employee):?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $employee['name'] ?></td>
            <td><?= $employee['email'] ?></td>
            <td><?= $employee['department'] ?></td>
            <td>
              <a href="show.php?show=<?= $employee['id'] ?>" class="btn btn-info">Show</a>
              <a href="edit.php?edit=<?= $employee['id'] ?>" class="btn btn-warning">Edit</a>
              <a href="?delete=<?= $employee['id'] ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
          <!-- If No Data -->
           <?php else: ?>
          <tr>
            <td colspan="7" class="text-center">no data to show</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>




<?php
require_once '../shared/footer.php';
?>
