<?php
require_once "assets/php/processbook.php";


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Managment System </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="styles.css" rel="stylesheet">

</head>

<body>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert <?= $_SESSION['message_type']; ?>" role="alert">
        <?= $_SESSION['message']; ?>
    </div>

    <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
<?php endif; ?>

<?php
 
?>
    <div class="container mt-5" style="width: 80%; margin: 0 auto;" id="updateForm">
  <div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="card-body">

<h2>Edit Book</h2>
<form method='post' action="assets/php/processbook.php">
    <label for="book_id">Book ID:</label>
    <input type="text" id="book_id" name="book_id" value="<?= $row[0]; ?>" readonly><br><br>

    <label for="book_name">Book Name:</label>
    <input type="text" id="book_name" name="book_name" value="<?= $row[1]; ?>" required><br><br>

    <label for="book_category">Book Category:</label>
    <input type="text" id="book_category" name="book_category" value="<?= $row[2]; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>
</div>
  </div>
</div>
 



    
    <?php
    $sql = "SELECT * FROM book";

    $result = $database->query($sql) or die($database->error);
    ?>

    <!-- Book Table -->
<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <div class="card-body" style="overflow: auto;">
        <table class="table table-hover">
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Book Category ID</th>
                <th>Action</th>
        </tr>

        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['book_id'] ?></td>
                    <td><?= $row['book_name'] ?></td>
                    <td><?= $row['category_id'] ?></td>
                    
                    <td><center>
                          <a  style="margin-right: 5px; text-decoration: none;" data-bookid="<?php echo $row['book_id']; ?>" class="edit-btn">
                            <i class="far fa-edit" style="color:green" data-toggle="tooltip"></i>

                            </a>
                            <a href="" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#deleteItem" data-bookid="<?php echo $row['book_id']; ?>" class="delete-btn">
                            <i class="fa fa-trash" style="color:red" data-toggle="tooltip"></i>

                            </a>
                        </center></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="7" style="text-align: center">No records are available!</td>
            </tr>
        <?php } ?>
    </table>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="assets/php/processbook.php">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                        <input type="hidden" name="bookId" id="deleteUserId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" name="delete" value="delete" data-bs-dismiss="modal">
                    </div>
            </div>
        </div>
    </div>


    
    
      <!-- Page Content Area Ends -->


      <!-- Page Content Area Ends -->

</div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

    <!-- <script src="libscript.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/books.js"></script>


    
</body>

</html>