<?php
require_once "assets/php/fine_process.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="assets/css/fine_styles.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert <?= $_SESSION['message_type']; ?>" role="alert">
            <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
    <?php endif; ?>

    <div class="container mt-5" style="width: 80%; margin: 0 auto;" id="updateForm">
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert <?= $_SESSION['message_type']; ?>" role="alert">
                <?= $_SESSION['message'] ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">

                <h2 class="card-title text-center mb-4">Update Fine details</h2>

                <form action="assets/php/fine_process.php" method="POST" class="needs-validation" onsubmit="return validateForm()">

                    <div class="mb-3">
                        <label for="fine_id" class="form-label">Fine ID: </label>
                        <input type="text" class="form-control" id="fine_id" name="fine_id" value="<?= isset($fine_id) ? $fine_id : '' ?>" required autocomplete='off' readonly>
                        <div class="invalid-feedback" id="firstNameError">Please enter Fine ID.</div>
                    </div>

                    <div class="mb-3">
                        <label for="book_id" class="form-label">Book ID: </label>
                        <input type="text" class="form-control" id="book_id" name="book_id" value="<?= isset($book_id) ? $book_id : '' ?>" required autocomplete='off' readonly>
                        <div class="invalid-feedback" id="firstNameError">Please enter Book ID.</div>
                    </div>

                    <div class="mb-3">
                        <label for="member_id" class="form-label">Member ID: </label>
                        <input type="text" class="form-control" id="member_id" name="member_id" value="<?= isset($member_id) ? $member_id : '' ?>" required autocomplete='off'>
                        <div class="invalid-feedback" id="firstNameError">Please enter Member ID.</div>
                    </div>

                    <div class="mb-3">
                        <label for="fine_amount" class="form-label">Fine Amount (LKR): </label>
                        <input type="text" class="form-control" id="fine_amount" name="fine_amount" value="<?= isset($fine_amount) ? $fine_amount : '' ?>" required autocomplete='off'>
                        <div class="invalid-feedback" id="firstNameError">Please enter Fine Amount.</div>
                    </div>

                    <div class="mb-3">
                        <input type="datetime-local" hidden class="form-control" id="date_modified" name="fine_date_modified" value="<?= date('Y-m-d\TH:i:s') ?>" required autocomplete='off'>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block" name="update">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>



    <div class="container mt-4">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body" style="overflow: auto;">
                <h2 class="card-title text-center mb-4">Fine Records</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fine ID</th>
                            <th>Member ID</th>
                            <th>Member Name</th>
                            <th>Book name</th>
                            <th>Fine amount in LKR</th>
                            <th>Date Modified</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT *
                                    FROM fine
                                    INNER JOIN member
                                    ON fine.member_id=member.member_id
                                    INNER JOIN book
                                    ON fine.book_id=book.book_id";
                    $result = $database->query($sql);
                    ?>
                    <?php if ($result->num_rows > 0) { ?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['fine_id'] ?></td>
                                <td><?= $row['member_id'] ?></td>
                                <td><?= $row['first_name'] ?> <?= $row['last_name'] ?></td>
                                <td><?= $row['book_name'] ?></td>
                                <td><?= $row['fine_amount'] ?></td>
                                <td><?= $row['fine_date_modified'] ?></td>

                                <td>
                                    <center>
                                        <a style="margin-right: 5px; text-decoration: none;" data-fineid="<?php echo $row['fine_id']; ?>" class="edit-btn">
                                            <i class="far fa-edit" style="color:green" data-toggle="tooltip"></i></a>
                                        <a style="margin-right: 5px;" data-fineid="<?php echo $row['fine_id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteItem" class="delete-btn">
                                            <i class="fa fa-trash" style="color:red" data-toggle="tooltip"></i></a>
                                    </center>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>

            </div>
        </div>

    </div>



    <!-- Delete Modal -->
    <div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="assets/php/fine_process.php">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                        <input type="hidden" name="user_id" id="deleteUserId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" name="delete" value="delete" data-bs-dismiss="modal">
                    </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="assets/js/fine_list.js"></script>
</body>

</html>