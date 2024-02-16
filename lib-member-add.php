<?php
    include 'assets/php/config.php';
    if(isset($_POST['submit'])){
        $member_id = $_POST['member_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        

        // Check if the member_id already exists in the database
        $check_query = "SELECT * FROM member WHERE member_id = '$member_id'";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // member with the same member_id already exists
            echo '<script>alert("member with the same ID already exists!");</script>';
        } else {
            // Insert the new member record
            $sql = "INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES ('$member_id', '$first_name', '$last_name', '$birthday', '$email')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                header('location:index.php');
            } else {
                die(mysqli_error($con));
            }
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> Library Member Registration</title>
  </head>
  <body>
    
  <div class="container mt-5" style="width: 80%; margin: 0 auto;">
  <div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="card-body">
            <h2 class="card-title text-center mb-4">Add New Member</h2>
                    </div>
                    <form method="post" action="assets/php/lib-members.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="member_id">Member ID</label>
                            <input type="text" class="form-control mt-2" id="member_id" name="member_id" placeholder="Enter Member ID(eg.M001)" autocomplete="off">
                        </div>
                        <div class="form-group mt-4">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control mt-2" id="first_name" name="first_name" placeholder="Enter First Name" autocomplete="off">
                        </div>
                        <div class="form-group mt-4">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control mt-2" id="last_name" name="last_name" placeholder="Enter Last Name" autocomplete="off">
                        </div>
                        <div class="form-group mt-4">
                            <label for="birthday">Birthday</label>
                            <input type="date" class="form-control mt-2" id="birthday" name="birthday" placeholder="Enter Birthday" autocomplete="off">
                        </div>
                        <div class="form-group mt-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control mt-2" id="email" name="email" required placeholder="sample@mymail.com" autocomplete="off">
                        </div>
                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-success me-2 mt-4" name="submit" id="submit" >Add Member</button>
                            <button type="button" class="btn btn-danger  mt-4" onclick="closeForm()">Close</button>
                        </div>                                               
                    </form>
                </div>
            </div>
        </div>

        </div>
  </div>
</div>


    <!--Boostrap Jquery-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--Boostrap Javascript-->
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   

    <script>
         function validateForm() {
            // Get input values
            var member_id = document.getElementById("member_id").value;
            var first_name = document.getElementById("first_name").value;
            var last_name = document.getElementById("last_name").value;
            var birthday = document.getElementById("birthday").value;
            var email = document.getElementById("email").value;
            

            // Check if any field is empty
            if (member_id === "" || first_name === "" || last_name === "" || birthday === "" || email === "") {
                alert("Please fill in all fields");
                return false;
            }

            // Validate Member ID format using a regular expression
            var memberIdRegex = /^M\d{3}$/;
            if (!memberIdRegex.test(member_id)) {
                alert("Invalid Member ID format. It should be in the 'M<MEMBER_ID>' format (e.g: M001).");
                return false;
            }

            return true;
        }
        function closeForm() {
            
            alert("Form closed!");
            window.location.href ='index.php';
        }
    </script>


  </body>
</html>
