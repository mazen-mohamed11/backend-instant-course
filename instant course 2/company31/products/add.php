<?php
require_once "c:xampp/htdocs/instant course 2/company31/apps/configDB.php";
require_once '../shared/header.php';
require_once '../shared/navbar.php';



$categoryQuery = "SELECT * FROM  `category`";
$categories = mysqli_query($con, $categoryQuery);
$message = '';
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $insertQuery = "INSERT INTO `products` VALUES (NULL,'$title','$description',$price,$category_id)";
    $insert = mysqli_query($con, $insertQuery);
    if ($insert) {
        $message = 'Product added successfully';
    }
}

?>


<div class="container col-6 pt-5">
    <h2 class="text-center text-light">Add New Product</h2>
    <div class="card border-0">
        <div class="card-body bg-dark text-light">
            <!-- Start Of Event -->
            <?php if (!empty($message)): ?>
                <div class="alert alert-success">
                    <p class="fs-4 mb-0">Product Added Successfully</p>
                </div>
            <?php endif; ?>
            <!-- End of Event -->
            <form method="POST">
                <div class="row">
                    <div class="form-group col-md-6 mb-2">
                        <label for="title" class="form-label"> Title </label>
                        <input type="text" class="form-control" id="title" name="title" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="description" class="form-label"> Description </label>
                        <textarea
                            rows="1"
                            class="form-control"
                            id="description"
                            name="description" >
                        </textarea>
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="price" class="form-label"> Price </label>
                        <input
                            type="text"
                            class="form-control"
                            id="price"
                            name="price" />
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="category" class="form-label"> Category </label>
                        <select
                            name="category_id"
                            id="category"
                            class="form-select">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary" name="submit">
                            Add Product
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