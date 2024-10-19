<?php
require_once "c:xampp/htdocs/instant course 2/company31/apps/configDB.php";
require_once "c:xampp/htdocs/instant course 2/company31/apps/functions.php";
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$department = '';
if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $selectOneQuery = "SELECT * FROM `departments` WHERE id = $id";
  $selectOne = mysqli_query($con,$selectOneQuery);
  $row = mysqli_fetch_assoc($selectOne);
  $department = $row['department'];
  if(isset($_POST['department'])){
    $department = $_POST['department'];
    $updateQuery = "UPDATE `departments` set department = '$department' where id = $id";
    $update = mysqli_query($con,$updateQuery);
    if($update){
      Path('departments/list.php');
    }
  }
}

?>


<div class="container col-6 pt-5">
  <h2 class="text-center text-light">Update Department</h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <form method="POST">
        <div class="form-group mb-2">
          <label for="department" class="form-label"> Department </label>
          <input
            type="text"
            value="<?= $department ?>"
            class="form-control"
            id="department"
            name="department"
          />
        </div>
        <div class="text-center">
          <button class="btn btn-warning">Update Department</button>
        </div>
      </form>
    </div>
  </div>
</div>

 

<?php
require_once '../shared/footer.php';
?>    