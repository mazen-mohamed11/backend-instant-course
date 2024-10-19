<?php
require_once "c:xampp/htdocs/instant course 2/company31/apps/configDB.php";
require_once "c:xampp/htdocs/instant course 2/company31/apps/functions.php";
require_once '../shared/header.php';
require_once '../shared/navbar.php';



$departmentsQuery = "SELECT * FROM  `departments`";
$departments = mysqli_query($con, $departmentsQuery);
$name = '';
$email = '';
$password = '';
$department_id = '';
$address = '';
$phone = '';
$message = '';
$errors = [];
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $selectEmployee = "SELECT * FROM `employees` where id = $id";
    $selectOne = mysqli_query($con, $selectEmployee);
    $row = mysqli_fetch_assoc($selectOne);
    $name = $row['name'];
    $email = $row['email'];
    $password = $row['password'];
    $department_id = $row['department_id'];
    $address = $row['address'];
    $phone = $row['phone'];
    if (isset($_POST['update'])) {
        $name = filterString($_POST['name']);
        $email = filterString($_POST['email']);
        $password = $_POST['password'];
        $department_id = $_POST['department_id'];
        $address = filterString($_POST['address']);
        $phone = filterString($_POST['phone']);

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

        if (empty($errors)) {
            if(!empty($row['image']['name'])){
                $realName = $_FILES['image']['name'];
                $imgName = "Company31.com_" . rand(0, 10000) . "_" . time() . "_" . $realName;
                $tmpName = $_FILES['image']['tmp_name'];
                $location = 'uploads/' . $imgName;
                $old_image = 'uploads/' . $row['image'];
                if ($row['image'] != "fake.webp") {
                    unlink($old_image);
                }
                move_uploaded_file($tmpName, $location);
            } 
            
            $updateQuery = "UPDATE `employees` set `name` = '$name',email = '$email',`password` = '$password',department_id = $department_id,`address` = '$address',phone = '$phone' ,`image` = '$imgName' where id = $id";
            $update = mysqli_query($con, $updateQuery);
            if ($update) {
                $message = 'Employee Updated successfully';
                Path('employees/list.php');
            }
        }
    }
}

?>


<div class="container col-6 pt-5">
    <h2 class="text-center text-light">Update Employee</h2>
    <div class="card border-0">
        <div class="card-body bg-dark text-light">
            <!-- Start Of Event -->
            <?php if (!empty($message)): ?>
                <div class="alert alert-success">
                    <p class="fs-4 mb-0">Employee Updated Successfully</p>
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
                        <input type="text" value="<?= $name ?>" class="form-control" id="name" name="name" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="email" class="form-label"> Email </label>
                        <input
                            type="email"
                            value="<?= $email ?>"
                            class="form-control"
                            id="email"
                            name="email" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="phone" class="form-label"> Phone </label>
                        <input
                            type="text"
                            value="<?= $phone ?>"
                            class="form-control"
                            id="phone"
                            name="phone" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="password" class="form-label"> Password </label>
                        <input
                            type="password"
                            value="<?= $password ?>"
                            class="form-control"
                            id="password"
                            name="password" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="address" class="form-label"> Address </label>
                        <input
                            type="text"
                            value="<?= $address ?>"
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
                                <?php if ($department_id == $department['id']): ?>
                                    <option selected value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 mb-2">
                        <label for="image" class="form-label">Employee Image</label>
                        <input type="file" class="form-control mb-2" id="image" name="image">
                        <img width="150" src="uploads/<?= $row['image'] ?>" alt="">
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-warning" name="update">
                            Update Employee
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