<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include Bootstrap, CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/register-login-form.css" rel="stylesheet">
</head>

<body style="background-image: url(assets/img/lib-img.jpeg);">
    <h1 class="text-center mt-5 text-white">Library Managment System</h1>

    <div class="container mt-5" id="main_container" style="width: 65%; margin: 0 auto; ">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#login-form" role="tab" id="login-tab"> Sign In </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#signup-form" role="tab" id="signup-tab"> Sign Up </a>
                    </li>
                </ul>

                <div class="tab-content pt-2" id="tab-content">
                    <div class="tab-pane active" id="login-form" role="tabpanel" aria-labelledby="justified-tab-0">

                        <form id="loginForm" class="needs-validation mt-3" onsubmit="event.preventDefault();">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="login-username" placeholder="Enter Username" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="login-password" placeholder="Enter Password" required>
                                
                            </div>
                            
                            <p class="text-center text-danger" id="errorMessage"></p>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block"
                                    onclick="userLogin()">Login</button>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane" id="signup-form" role="tabpanel" aria-labelledby="justified-tab-1">

                        <form id="registrationForm" class="needs-validation mt-3" onsubmit="event.preventDefault();">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Enter First Name"
                                    required>
                                <div class="invalid-feedback" id="firstNameError">Please enter your First Name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name"
                                    required>
                                <div class="invalid-feedback" id="lastNameError">Please enter your Last Name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email"
                                    onkeyup="checkEmailAvailability()" required>
                                <div class="invalid-feedback" id="emailError">Please enter a valid Email.</div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter Username"
                                    onkeyup="checkUsernameAvailability()" required>
                                <div class="invalid-feedback" id="usernameError">Please enter a valid Username.</div>
                            </div>
                            <div class="mb-3">
                                <label for="userId" class="form-label">User ID</label>
                                <div class="input-group mb-3 user-id-wrapper">
                                    <span class="input-group-text user-id-prefix">U</span>
                                    <input type="text" class="form-control user-id-input" id="userId"
                                        placeholder="Enter User ID"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                </div>
                                <div class="invalid-feedback" id="userIdError">Please enter a valid User ID.</div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password"
                                    onkeyup="checkPassword()" required>
                                <div class="invalid-feedback" id="passwordError">Password must be at least 8 characters.
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block"
                                    onclick="registerUser()">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/register-login-form.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>