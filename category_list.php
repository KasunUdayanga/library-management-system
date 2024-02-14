<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include Bootstrap, CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="assets/css/user-register.css" rel="stylesheet">

</head>
<div class="container mt-5" style="width: 80%; margin: 0 auto;" id="updateForm">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Edit Details</h2>
                <form id="updateUserForm" class="needs-validation" method="post" action="category_add.php">
            <div class="mb-3">
                <label for="categoryID" class="form-label">Category ID:</label>
                <input type="text" class="form-control" id="categoryID" name="categoryID" value="<?= isset($editCategoryID) ? $editCategoryID : '' ?>" required>
                <small class="error-message">
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add']) && !validate_category_id($_POST['categoryID'])) echo "Invalid Category ID format. Example: C001"; ?>
                </small>
            </div>
            <div class="mb-3">
                <label for="categoryName"  class="form-label">Category Name:</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?= isset($editCategoryName) ? $editCategoryName : '' ?>" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-block"  name="update">Update Category
                </button>
                    <input type="hidden" name="originalCategoryID" id="originalCategoryID">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger" style="margin-left: 10px;">Cancel</a>
            </div>
        </form>

            </div>

        </div>
    </div>

<div class="container mt-4">
        <div class="card shadow p-3 mb-5 bg-body rounded">
        <div class="card-body" style="overflow: auto;">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Date Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                        include 'assets/php/config.php';

                $result = $database->query("SELECT * FROM bookcategory") or die($database->error);

                while ($row = $result->fetch_assoc()) :
                ?>
                    <tr>
                        <td><?= $row['category_id'] ?></td>
                        <td><?= $row['category_Name'] ?></td>
                        <td><?= $row['date_modified'] ?></td>
                        <td>
                        <center>
                                            <a  style="margin-right: 5px; text-decoration: none;" data-catid="<?php echo $row['category_id']; ?>" class="edit-btn">
                                                <i class="far fa-edit" style="color:green" data-toggle="tooltip"></i>

                                            </a>
                                            <a href="" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#deleteItem" data-catid="<?php echo $row['category_id']; ?>" class="delete-btn">
                                                <i class="fa fa-trash" style="color:red" data-toggle="tooltip"></i>

                                            </a>
                                        </center>
                </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
         </div>
        </div>
    </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="category_add.php">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                        <input type="hidden" name="cat_id" id="deleteCatId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" name="delete" value="delete" data-bs-dismiss="modal">
</div> 
                </form>
            </div>
        </div>
    </div>

          <!-- Include Bootstrap JS -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="assets/js/category.js"></script>



</body>

</html>