<?php
include 'config.php';


// Check username
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];

    $stmt = $database->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $available = false;
        $user = $result->fetch_assoc(); 

    } else {
        $available = true;
        $user = null; // User does not exist, no data to retrieve

    }

    header('Content-Type: application/json');
    echo json_encode(['available' => $available,'data' => $user]);
    exit;
}

//Check email
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    $stmt = $database->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $available = false;
    } else {
        $available = true;
    }

    header('Content-Type: application/json');
    echo json_encode(['available' => $available]);
    exit;
}

//Check User ID
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    $stmt = $database->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $available = false;
        $user = $result->fetch_assoc(); 

    } else {
        $available = true;
        $user = null; // User does not exist, no data to retrieve

    }

    header('Content-Type: application/json');
    echo json_encode(['available' => $available,'data' => $user]);
    exit;
}

//Login User
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login_username'])) {
    $username = $_POST['login_username'];
    $password = $_POST['password'];

    $error = "";


    // Fetch user from the database using userId
    $stmt = $database->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            session_start();

            // Password is correct
            $_SESSION['username'] = $username;

            $status = true;

        } else {
            // Incorrect password
            $status = false;
            $error = "Username or Password Incorrect!";
        }
    } else {
        // User not found
        $status = false;
        $error = "User not found!";
    }
   
    header('Content-Type: application/json');
    echo json_encode(['status' => $status, 'error' => $error]);
    exit;
}

//Delete User
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])){
    
    $id = $_POST['user_id'];
    //delete query
    $sql = "DELETE FROM user WHERE user_id = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $id);


    if ($stmt->execute()) {
        
        header('location:index.php?message=Record deleted successfully');
    } else {
        //delete error
        header('location:index.php?message=Error deleting record:' . $conn->error);
    }
}

//Update User
if (isset($_POST['update'])) {
    $userId = $_POST['user_id'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['e_mail'];
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $preUserId = $_POST['pre_user_id'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);



    // Add other form fields as needed

    // Prepare SQL statement to update user details
    $stmt = $database->prepare("UPDATE user SET first_name = ?, last_name = ? , email = ?, username = ? , password = ?  WHERE user_id = ?");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $username, $hashedPassword, $userId);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // User details updated successfully
        header('Location: ../../index.php?message=User details updated successfully');
        $_SESSION['message'] = "User details updated successfully";

        exit;
    } else {
        // Error updating user details
        header('Location:  ../../index.php?message=Error updating user details');
        $_SESSION['message'] = "Error updating user details";

        exit;
    }
}


//Insert New User
if ($_SERVER["REQUEST_METHOD"]  === "POST" ) {

    $inputJSON = file_get_contents('php://input');

    // Decode the JSON data to a PHP object
    $data = json_decode($inputJSON);

    $userId = $data->userId;
    $email = $data->email;
    $firstName = $data->firstName;
    $lastName = $data->lastName;
    $username = $data->username;
    $password = $data->password; 
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


    // Insert data into the database
    $stmt = $database->prepare("INSERT INTO user (user_id, email, first_name, last_name, username, password ) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $userId, $email, $firstName, $lastName, $username, $hashedPassword);


    if ($stmt->execute()) {
        // Insert successful
        echo json_encode(['success' => true]);
        
        
        exit;
    } else {
        // Insert failed
        echo json_encode(['success' => false, 'error' => 'Insertion failed: ' . $stmt->error]);
        exit;
    }
}



if (isset($_GET['edit'])) {
    $username = $_SESSION['username']; // Get the username from the URL
    $update = true;

    // Fetch user details from the database based on the username
    $stmt = $database->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record is found
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc(); // Fetch user details
        $Uid = $row['user_id'];
        $Fname = $row['first_name'];
        $Lname = $row['last_name'];
        $email = $row['email'];
    }
}



?>