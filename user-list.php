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
                <form id="updateUserForm" class="needs-validation" method="post" action="assets/php/user.php">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstName" placeholder="Enter First Name" required>
                        <div class="invalid-feedback" id="firstNameError">Please enter your First Name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Enter Last Name" required>
                        <div class="invalid-feedback" id="lastNameError">Please enter your Last Name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="e_mail" placeholder="Enter Email" onkeyup="checkEmailAvailability()" required>
                        <div class="invalid-feedback" id="emailError">Please enter a valid Email.</div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="user_name" placeholder="Enter Username" onkeyup="checkUsernameAvailability()" value="<?php echo $_SESSION['username']; ?>" required>
                        <div class="invalid-feedback" id="usernameError">Please enter a valid Username.</div>
                    </div>
                    <div class="mb-3">
                        <label for="userId" class="form-label">User ID</label>
                        <div class="input-group mb-3 user-id-wrapper">
                            <input type="text" class="form-control user-id-input" name="user_id" id="userId" placeholder="Enter User ID" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        </div>
                        <div class="invalid-feedback" id="userIdError">Please enter a valid User ID.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" onkeyup="checkPassword()" required>
                        <div class="invalid-feedback" id="passwordError">Password must be at least 8 characters.</div>
                    </div>
                    <input type="hidden" name="pre_user_id" id="editUserId">
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
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include 'assets/php/config.php';

                        //$sql = "SELECT * FROM user";

                        $stmt = $database->prepare("SELECT * FROM user");

                        $stmt->execute();

                        $result = $stmt->get_result();


                        if ($result->num_rows > 0) {


                            while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                                <tr>
                                    <td><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td>
                                        <center>
                                            <a  style="margin-right: 5px; text-decoration: none;" data-userid="<?php echo $row['user_id']; ?>" class="edit-btn">
                                                <i class="far fa-edit" style="color:green" data-toggle="tooltip"></i>

                                            </a>
                                            <a href="" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#deleteItem" data-userid="<?php echo $row['user_id']; ?>" class="delete-btn">
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
                <form method="post" action="assets/php/user.php">
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

    



        <!-- Include Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="assets/js/users-list.js"></script>
        <script src="assets/js/profile.js"></script>



</body>

</html>