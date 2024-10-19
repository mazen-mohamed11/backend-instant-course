<?php
require_once "c:xampp/htdocs/instant course 2/company31/apps/configDB.php";
require_once '../shared/header.php';
require_once '../shared/navbar.php';



$categoryQuery = "SELECT * FROM  `category`";
$categories = mysqli_query($con, $categoryQuery);
$title = '';
$description = '';
$price = '';
$category_id = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $selectProduct = "SELECT * FROM `products` where id = $id";
    $selectOne = mysqli_query($con, $selectProduct);
    $row = mysqli_fetch_assoc($selectOne);
    $title = $row['title'];
    $description = $row['description'];
    $price = $row['price'];
    $category_id = $row['category_id'];
    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $updateQuery = "UPDATE `products` set title = '$title',`description` = '$description',price = $price,category_id = $category_id where id = $id";
        $update = mysqli_query($con, $updateQuery);
        if ($update) {
            Path('products/list.php');
        }
    }
}


?>


<div class="container col-6 pt-5">
    <h2 class="text-center text-light">Update Product</h2>
    <div class="card border-0">
        <div class="card-body bg-dark text-light">
            <!-- Start Of Event -->
            <!-- <?php if (!empty($message)): ?>
                <div class="alert alert-success">
                    <p class="fs-4 mb-0">Product Updated Successfully</p>
                </div>
            <?php endif; ?> -->
            <!-- End of Event -->
            <form method="POST">
                <div class="row">
                    <div class="form-group col-md-6 mb-2">
                        <label for="title" class="form-label"> Title </label>
                        <input type="text" value="<?= $title ?>" class="form-control" id="title" name="title" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="description" class="form-label"> Description </label>
                        <input
                            type="text"
                            value="<?= $description ?>"
                            class="form-control"
                            id="description"
                            name="description" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="price" class="form-label"> Price </label>
                        <input
                            type="text"
                            value="<?= $price ?>"
                            class="form-control"
                            id="price"
                            name="price" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="category" class="form-label"> category </label>
                        <select
                            name="category_id"
                            id="category"
                            class="form-select">
                            <?php foreach ($categories as $category): ?>
                                <?php if ($category_id == $category['id']): ?>
                                    <option selected value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-warning" name="update">
                            Update Product
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


