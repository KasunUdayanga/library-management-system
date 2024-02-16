<!-- Include Bootstrap, CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/user-register.css" rel="stylesheet">

<?php
       session_start();


        //Get selected id form URL param and get all data related to that id.
      
    
?>


<div class="container mt-5" style="width: 80%; margin: 0 auto;">
  <div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="card-body">
      <h2 class="card-title text-center mb-4">Profile</h2>
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

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/profile.js"></script>