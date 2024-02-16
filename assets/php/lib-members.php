<?php
include 'config.php';

if(isset($_POST['submit'])){
    $member_id = $_POST['member_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    

    // Check if the member_id already exists in the database
    $check_query = "SELECT * FROM member WHERE member_id = '$member_id'";
    $check_result = mysqli_query($database, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // member with the same member_id already exists
        echo '<script>alert("member with the same ID already exists!");</script>';
    } else {
        // Insert the new member record
        $sql = "INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES ('$member_id', '$first_name', '$last_name', '$birthday', '$email')";
        $result = mysqli_query($database, $sql);

        if ($result) {
            header("Location: ../../index.php?message= Member added Successfull!");
        } else {
            die(mysqli_error($con));
        }
    }
}

//Delete User

if(isset($_POST['delete'])){
    $member_id=$_POST['member_id'];

    $sql = "DELETE FROM member WHERE member_id='$member_id'";
    $result=mysqli_query($database,$sql);
    if($result){
        //echo "Deleted Successfully";
        header("Location: ../../index.php?message= Member Deleted Successfull!");
    }else{
        die(mysqli_error($database));
    }
}


//update member

if(isset($_POST['update'])){
    $new_member_id = $_POST['member_id']; // Get the new member ID
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $old_member_id=$new_member_id;


    // Check if the new member ID is already exists
    if ($new_member_id !== $old_member_id) {
        $check_sql = "SELECT COUNT(*) AS count FROM member WHERE member_id='$new_member_id'";
        $check_result = mysqli_query($database, $check_sql);
        $check_row = mysqli_fetch_assoc($check_result);
        if ($check_row['count'] > 0) {
            echo "Member ID already exists!";
            exit(); // Stop execution
        }
    }

    $sql = "UPDATE member SET member_id='$new_member_id', first_name='$first_name',last_name='$last_name',birthday='$birthday', email='$email' where member_id='$old_member_id'";
    
    $result=mysqli_query($database,$sql);

    if ($result){
        header("Location: ../../index.php?message= Member Updated Successfull!");
        //echo "Updated successfully";
    }else{
        die(mysqli_error($database));
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['member_id'])) {
    $member_id = $_POST['member_id'];

    $stmt = $database->prepare("SELECT * FROM member WHERE member_id = ?");
    $stmt->bind_param("s", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $available = false;
        $member = $result->fetch_assoc(); 

    } else {
        $available = true;
        $member = null; // User does not exist, no data to retrieve

    }

    header('Content-Type: application/json');
    echo json_encode(['available' => $available,'data' => $member]);
    exit;
}


   
?>