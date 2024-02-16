<?php
require_once "config.php";

session_start();

$update = false;
$borrow_id = "";
$book_id = "";
$member_id = "";
$borrow_status = "";
$borrower_date_modified = "";

if(isset($_POST['submit'])){
    $borrow_id = mysqli_real_escape_string($database, $_POST['borrow_id']);
    $book_id = mysqli_real_escape_string($database, $_POST['book_id']);
    $member_id = mysqli_real_escape_string($database, $_POST['member_id']);
    $borrow_status = mysqli_real_escape_string($database, $_POST['borrow_status']);
    $borrower_date_modified = date("Y-m-d h:i:sa"); // Modified date format
    // Validation
   

    // Check if the fine_id exists in the fine table
    $check_fine_query = "SELECT * FROM bookborrower WHERE borrow_id = '$borrow_id'";
    $check_fine_result = mysqli_query($database, $check_fine_query);

    if (mysqli_num_rows($check_fine_result) > 0) {
        // fine with the same fine_id already exists
        $_SESSION['borrow_message'] = "Fine ID already exists!";
        $_SESSION['borrow_message_type'] = "danger";
        header("Location: ../../index.php?message=".$_SESSION['borrow_message']);
        exit();
    }

    // Check if the book_id exists in the book table
    $check_book_query = "SELECT * FROM book WHERE book_id = '$book_id'";
    $check_book_result = mysqli_query($database, $check_book_query);

    if (mysqli_num_rows($check_book_result) == 0) {
        // Book with the given ID does not exist
        $_SESSION['borrow_message'] = "Book ID does not exist!";
        $_SESSION['borrow_message_type'] = "danger";
        header("Location: ../../index.php?message=".$_SESSION['borrow_message']);
        exit();
    }

    // Check if the member_id exists in the member table
    $check_member_query = "SELECT * FROM member WHERE member_id = '$member_id'";
    $check_member_result = mysqli_query($database, $check_member_query);

    if (mysqli_num_rows($check_member_result) == 0) {
        // Member with the given ID does not exist
        $_SESSION['borrow_message'] = "Member ID does not exist!";
        $_SESSION['borrow_message_type'] = "danger";
        header("Location: ../../index.php?message=".$_SESSION['borrow_message']);
        exit();
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id,borrow_status, borrower_date_modified) 
            VALUES ('$borrow_id', '$book_id', '$member_id', '$borrow_status', '$borrower_date_modified')";

    // Execute the SQL statement and handle errors
    if ($database->query($sql)) {
        $_SESSION['borrow_message'] = "Borrow Details added successfully";
        $_SESSION['borrow_message_type'] = "success";
        header("Location: ../../index.php?message=".$_SESSION['borrow_message']);
        exit();
    } else {
        $_SESSION['borrow_message'] = "Error: " . $database->error;
        $_SESSION['borrow_message_type'] = "danger";
        header("Location: ../../index.php?message=".$_SESSION['borrow_message']);
        exit();
    }
}


if (isset($_POST['delete'])) {
    $borrow_id = mysqli_real_escape_string($database, $_POST['user_id']);

    $sql = "DELETE FROM bookborrower WHERE borrow_id='$borrow_id'";
    try {
        if ($database->query($sql)) {
            $_SESSION['borrow_message'] = "Borrow delete successfully";
            $_SESSION['borrow_message_type'] = "success";
        } else {
            throw new Exception("Error: " . $database->error);
        }
    } catch (Exception $e) {
        $_SESSION['borrow_message'] = $e->getMessage();
        $_SESSION['borrow_message_type'] = "danger";
    }
    header("Location: ../../index.php?message=".$_SESSION['borrow_message']);
    exit(); // Add exit here
}

if (isset($_GET['edit'])) {
    $borrow_id = mysqli_real_escape_string($database, $_GET['edit']);
    $update = true;

    $sql = "SELECT * FROM bookborrower WHERE borrow_id='$borrow_id' ";
    $result = $database->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $fine_id = $row['borrow_id'];
        $book_id = $row['book_id'];
        $member_id = $row['member_id'];
        $borrow_status = $row['borrow_status'];
        $borrower_date_modified = $row['borrower_date_modified'];
    }
}

if (isset($_POST['update'])) {
    $borrow_id = mysqli_real_escape_string($database, $_POST['borrow_id']);
    $book_id = mysqli_real_escape_string($database, $_POST['book_id']);
    $member_id = mysqli_real_escape_string($database, $_POST['member_id']);
    $borrow_status = mysqli_real_escape_string($database, $_POST['borrow_status']);
    $borrower_date_modified = date("Y-m-d h:i:sa"); // Modified date format

    // Check if the user is trying to update fine_id or book_id
    if ($borrow_id != $_POST['borrow_id']) {
        $_SESSION['borrow_message'] = "You cannot edit Fine ID";
        $_SESSION['borrow_message_type'] = "danger";
       
    }

    if ($book_id != $_POST['book_id']) {
        $_SESSION['borrow_message'] = "You cannot edit Book ID";
        $_SESSION['borrow_message_type'] = "danger";
        
    }

    $check_member_query = "SELECT * FROM member WHERE member_id = '$member_id'";
    $check_member_result = mysqli_query($database, $check_member_query);

    if (mysqli_num_rows($check_member_result) == 0) {
        // Member with the given ID does not exist
        $_SESSION['borrow_message'] = "You entered a member ID that does not exist!";
        $_SESSION['borrow_message_type'] = "danger";
    } else { 
        $sql = "UPDATE bookborrower SET member_id='$member_id', borrow_status='$borrow_status', borrower_date_modified='$borrower_date_modified' WHERE borrow_id='$borrow_id' ";
    
        try {
            if ($database->query($sql)) {
                $_SESSION['borrow_message'] = "Borrow details updated successfully";
                $_SESSION['borrow_message_type'] = "success";
            } else {
                throw new Exception("Error: " . $database->error);
            }
        } catch (Exception $e) {
            $_SESSION['borrow_message'] = $e->getMessage();
            $_SESSION['borrow_message_type'] = "danger";
        }
    }
    
    header("Location: ../../index.php?message=".$_SESSION['borrow_message']);
    exit();
}

If ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['borrowID'])) {
    $catId = $_POST['borrowID'];

    $stmt = $database->prepare("SELECT * FROM bookborrower WHERE borrow_id = ?");
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

?>
