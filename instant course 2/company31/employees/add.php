<?php
require_once "c:xampp/htdocs/instant course 2/company31/apps/configDB.php";
require_once "c:xampp/htdocs/instant course 2/company31/apps/functions.php";
require_once '../shared/header.php';
require_once '../shared/navbar.php';



$departmentsQuery = "SELECT * FROM  `departments`";
$departments = mysqli_query($con, $departmentsQuery);
$message = '';
$errors = [];
if (isset($_POST['submit'])) {
  $name = filterString($_POST['name']);
  $phone = filterString($_POST['phone']);
  $email = filterString($_POST['email']);
  $password = $_POST['password'];
  $address = filterString($_POST['address']);
  $department_id = $_POST['department_id'];

  if (stringValidation($name, 4)) {
    $errors[] = "Employee name must be more than 4 characters";
  }
  if (stringValidation($email, 0)) {
    $errors[] = "Employee must enter an email";
  }
  if (stringValidation($address, 0)) {
    $errors[] = "Employee must enter an address";
  }
  if (stringValidation($phone, 11)) {
    $errors[] = "Employee phone must be more than 11 numbers";
  }
  //Upload image
  $realName = $_FILES['image']['name'];
  $imgSize = $_FILES['image']['size'];
  $imgName = "Company31.com_" . rand(0, 10000) . "_" . time() . "_" . $realName;
  $tmpName = $_FILES['image']['tmp_name'];
  $location = 'uploads/' . $imgName;
  if(imageValidation($realName,$imgSize,5)){
    $errors[] = "Image is required and must be less than 5 MB";
  }

  if (empty($errors)) {
    move_uploaded_file($tmpName, $location);
    $insertQuery = "INSERT INTO `employees` VALUES (NULL,'$name','$email','$password','$department_id','$address','$phone','$imgName')";
    $insert = mysqli_query($con, $insertQuery);
    if ($insert) {
      $message = 'Employee added successfully';
    }
  }
}


?>


<div class="container col-6 pt-5">
  <h2 class="text-center text-light">Add New Employee</h2>
  <div class="card border-0">
    <div class="card-body bg-dark text-light">
      <!-- Start Of Event -->
      <?php if (!empty($message)): ?>
        <div class="alert alert-success">
          <p class="fs-4 mb-0">Employee Added Successfully</p>
        </div>
      <?php endif; ?>
      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach($errors as $error):?>
              <li><?= $error ?></li>
              <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <!-- End of Event -->
      <form method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-md-6 mb-2">
            <label for="name" class="form-label"> Name </label>
            <input type="text" class="form-control" id="name" name="name" />
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="email" class="form-label"> Email </label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email" />
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="phone" class="form-label"> Phone </label>
            <input
              type="text"
              class="form-control"
              id="phone"
              name="phone" />
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="password" class="form-label"> Password </label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password" />
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="address" class="form-label"> Address </label>
            <input
              type="text"
              class="form-control"
              id="address"
              name="address" />
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="department" class="form-label"> department </label>
            <select
              name="department_id"
              id="department"
              class="form-select">
              <?php foreach ($departments as $department): ?>
                <option value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group col-12 mb-2">
            <label for="image" class="form-label">Employee Image</label>
            <input type="file" class="form-control" id="image" name="image">
          </div>
          <div class="col-12 text-center">
            <button class="btn btn-primary" name="submit">
              Add Employee
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>








<?php
require_once '../shared/footer.php';
?>