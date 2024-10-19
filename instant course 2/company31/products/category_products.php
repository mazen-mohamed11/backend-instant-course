<?php
require_once "c:xampp/htdocs/instant course 2/company31/apps/configDB.php";
require_once '../shared/header.php';
require_once '../shared/navbar.php';


if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];
    $category = $_GET['category'];
    $selectQuery = "SELECT * FROM `productwithcategory` where cat_id = $id";
    $select = mysqli_query($con, $selectQuery);
    $numOfRows = mysqli_num_rows($select);
}
?>


<div class="container col-6 pt-5">
    <div class="card border-0">
        <div class="card-body bg-dark text-light">
            <h2 class="text-center">All Products of category : <?= $category ?></h2>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($numOfRows > 0): ?>
                        <?php foreach ($select as $index => $product): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $product['title'] ?></td>
                                <td><?= $product['description'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td>

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