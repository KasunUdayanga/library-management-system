 
<?php
session_start();
require_once "config.php";


if (isset($_POST["submit"])){
    $book_id = $_POST["bookID"];
    $book_name = $_POST["bookName"];
    $book_category = $_POST["bookCategory"];

    // Construct the SQL query
    $sql = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$book_id', '$book_name', '$book_category')";

    // Execute the query

    try {
        $database->query($sql);

        $_SESSION ['message']="user add successfully";
        $_SESSION ['message_type']="success";
        header("Location: ../../index.php?message=Book added Successfull"); 
    }
    catch (Exception $e) {
        $_SESSION ["message"]= $e->getMessage();
        $_SESSION ["message_type"]= "danger";
        header("Location:../../index.php?message=Book added Failed"); 
    }

}


if (isset($_POST['delete'])) {
    $bookId = $_POST['bookId']; // Assuming 'bookId' is the query parameter for the book ID

    $sql = "DELETE FROM book WHERE book_id = '$bookId'";  

    try {
        $database->query($sql);

        $_SESSION['message'] = "Book deleted successfully."; // Update the success message
        $_SESSION['message_type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['message_type'] = "danger";
    }

    header("Location:../../index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['bookId'])) {
    $catId = $_POST['bookId'];

    $stmt = $database->prepare("SELECT * FROM book WHERE book_id = ?");
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

 

if (isset($_POST["update"])) {
    $book_id = $_POST["book_id"];
    $book_name = $_POST["book_name"];
    $book_category = $_POST["book_category"];

    // Construct the SQL query for update
    $sql = "UPDATE book SET book_name = '$book_name', category_id = '$book_category' WHERE book_id = '$book_id'";

    // Execute the query
    try {
        $database->query($sql);

        $_SESSION['message'] = "Book updated successfully";
        $_SESSION['message_type'] = "success";
        header("Location: ../../index.php?message=Book updated Successfull"); 

    } catch (Exception $e) {
        $_SESSION["message"] = $e->getMessage();
        $_SESSION["message_type"] = "danger";
        header("Location:../../index.php?message=Book updated Failed"); 

    }

}




 