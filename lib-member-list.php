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

<body>

    <div class="container mt-5" style="width: 80%; margin: 0 auto;" id="updateForm">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Edit Details</h2>
                <form id="updateMemberForm" class="needs-validation" method="post" action="assets/php/lib-members.php">
                    <div class="mb-3">
                        <label for="userId" class="form-label">Member ID</label>
                        <div class="input-group mb-3 user-id-wrapper">
                            <input type="text" class="form-control user-id-input" name="member_id" id="memberId" placeholder="Enter User ID" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Enter First Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter Last Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" onkeyup="checkEmailAvailability()" required>
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control mt-2" id="birthday" name="birthday" placeholder="Enter Birthday" autocomplete="off">
                    </div>
                    <input type="hidden" name="pre_member_id" id="editmemberId">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block" name="update" >Update</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
    </div>

    <div class="container mt-4">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body" style="overflow: auto;">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include 'assets/php/config.php';

                        //$sql = "SELECT * FROM user";

                        $stmt = $database->prepare("SELECT * FROM member");

                        $stmt->execute();

                        $result = $stmt->get_result();


                        if ($result->num_rows > 0) {


                            while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                                <tr>
                                    <td><?php echo $row['member_id']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['birthday']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td>
                                        <center>
                                            <a  style="margin-right: 5px; text-decoration: none;" data-userid="<?php echo $row['member_id']; ?>" class="edit-btn">
                                                <i class="far fa-edit" style="color:green" data-toggle="tooltip"></i>

                                            </a>
                                            <a href="" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#deleteItem" data-userid="<?php echo $row['member_id']; ?>" class="delete-btn">
                                                <i class="fa fa-trash" style="color:red" data-toggle="tooltip"></i>

                                            </a>
                                        </center>
                                    </td>

                                </tr>

                        <?php
                            }
                        } else {
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="assets/php/lib-members.php">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                        <input type="hidden" name="member_id" id="deletememberId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" name="delete" value="delete" data-bs-dismiss="modal">
                    </div>
            </div>
        </div>
    </div>

    



        <!-- Include Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="assets/js/lib-members.js"></script>



</body>

</html>