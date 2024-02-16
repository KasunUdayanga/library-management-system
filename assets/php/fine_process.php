<?php
require_once "config.php";

session_start();

$update = false;
$fine_id = "";
$book_id = "";
$member_id = "";
$fine_amount = "";
$fine_date_modified = "";

if(isset($_POST['submit'])){
    $fine_id = mysqli_real_escape_string($database, $_POST['fine_id']);
    $book_id = mysqli_real_escape_string($database, $_POST['book_id']);
    $member_id = mysqli_real_escape_string($database, $_POST['member_id']);
    $fine_amount = mysqli_real_escape_string($database, $_POST['fine_amount']);
    $fine_date_modified = date("Y-m-d h:i:sa"); // Modified date format
    // Validation
    if ($fine_amount < 2 || $fine_amount > 500) {
        $_SESSION['message'] = "Fine amount must be between 2 and 500 LKR.";
        $_SESSION['message_type'] = "danger";
        header("Location: ../../index.php?message=".$_SESSION['message']);
        exit();
    }

    // Check if the fine_id exists in the fine table
    $check_fine_query = "SELECT * FROM fine WHERE fine_id = '$fine_id'";
    $check_fine_result = mysqli_query($database, $check_fine_query);

    if (mysqli_num_rows($check_fine_result) > 0) {
        // fine with the same fine_id already exists
        $_SESSION['message'] = "Fine ID already exists!";
        $_SESSION['message_type'] = "danger";
        header("Location: ../../index.php?message=".$_SESSION['message']);
        exit();
    }

    // Check if the book_id exists in the book table
    $check_book_query = "SELECT * FROM book WHERE book_id = '$book_id'";
    $check_book_result = mysqli_query($database, $check_book_query);

    if (mysqli_num_rows($check_book_result) == 0) {
        // Book with the given ID does not exist
        $_SESSION['message'] = "Book ID does not exist!";
        $_SESSION['message_type'] = "danger";
        header("Location: ../../index.php?message=".$_SESSION['message']);
        exit();
    }

    // Check if the member_id exists in the member table
    $check_member_query = "SELECT * FROM member WHERE member_id = '$member_id'";
    $check_member_result = mysqli_query($database, $check_member_query);

    if (mysqli_num_rows($check_member_result) == 0) {
        // Member with the given ID does not exist
        $_SESSION['message'] = "Member ID does not exist!";
        $_SESSION['message_type'] = "danger";
        header("Location: ../../index.php?message=".$_SESSION['message']);
        exit();
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO fine (fine_id, book_id, member_id, fine_amount, fine_date_modified) 
            VALUES ('$fine_id', '$book_id', '$member_id', '$fine_amount', '$fine_date_modified')";

    // Execute the SQL statement and handle errors
    if ($database->query($sql)) {
        $_SESSION['message'] = "Fine added successfully";
        $_SESSION['message_type'] = "success";
        header("Location: ../../index.php?message= Fine added successfull!");
        exit();
    } else {
        $_SESSION['message'] = "Error: " . $database->error;
        $_SESSION['message_type'] = "danger";
        header("Location: ../../index.php?message= Fine added Failed!");
        exit();
    }
}


if (isset($_POST['delete'])) {
    $fine_id = mysqli_real_escape_string($database, $_POST['user_id']);

    $sql = "DELETE FROM fine WHERE fine_id='$fine_id'";
    try {
        if ($database->query($sql)) {
            $_SESSION['message'] = "Fine delete successfully";
            $_SESSION['message_type'] = "success";
        } else {
            throw new Exception("Error: " . $database->error);
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['message_type'] = "danger";
    }
    header("Location: ../../index.php?message= Deleted successfull!");
    exit(); // Add exit here
}


If ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['fineId'])) {
    $catId = $_POST['fineId'];

    $stmt = $database->prepare("SELECT * FROM fine WHERE fine_id = ?");
    $stmt->bind_param("s", $catId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $available = false;
        $cat = $result->fetch_assoc(); 

    } else {
        $available = true;
        $cat = null; // User does not exist, no data to retrieve

    }

    header('Content-Type: application/json');
    echo json_encode(['available' => $available,'data' => $cat]);
    exit;
}

if (isset($_POST['update'])) {
    $fine_id = mysqli_real_escape_string($database, $_POST['fine_id']);
    $book_id = mysqli_real_escape_string($database, $_POST['book_id']);
    $member_id = mysqli_real_escape_string($database, $_POST['member_id']);
    $fine_amount = mysqli_real_escape_string($database, $_POST['fine_amount']);
    $fine_date_modified = date("Y-m-d h:i:sa"); // Modified date format

    // Check if the user is trying to update fine_id or book_id
    if ($fine_id != $_POST['fine_id']) {
        $_SESSION['message'] = "You cannot edit Fine ID";
        $_SESSION['message_type'] = "danger";
       
    }

    if ($book_id != $_POST['book_id']) {
        $_SESSION['message'] = "You cannot edit Book ID";
        $_SESSION['message_type'] = "danger";
        
    }

    $check_member_query = "SELECT * FROM member WHERE member_id = '$member_id'";
    $check_member_result = mysqli_query($database, $check_member_query);

    if (mysqli_num_rows($check_member_result) == 0) {
        // Member with the given ID does not exist
        $_SESSION['message'] = "You entered a member ID that does not exist!";
        $_SESSION['message_type'] = "danger";
    } else { 
        $sql = "UPDATE fine SET member_id='$member_id', fine_amount='$fine_amount', fine_date_modified='$fine_date_modified' WHERE fine_id='$fine_id' ";
    
        try {
            if ($database->query($sql)) {
                $_SESSION['message'] = "Fine updated successfully";
                $_SESSION['message_type'] = "success";
            } else {
                throw new Exception("Error: " . $database->error);
            }
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['message_type'] = "danger";
        }
    }
    
    header("Location: ../../index.php?message=Fine updated successfully!");
    exit();
}

?>
