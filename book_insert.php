<?php
include 'assets/php/config.php';
// CRUD Operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        // Add new book category
        $categoryID = sanitize_input($_POST['categoryID']);
        $categoryName = sanitize_input($_POST['categoryName']);
        $dateModified = date('Y-m-d H:i:s');

        // Validate Category ID format
        if (!validate_category_id($categoryID)) {
            $_SESSION['message'] = "Invalid Category ID format. Example: C001";
            $_SESSION['msg_type'] = "danger";
        } else {
            try {
                $database->query("INSERT INTO bookcategory (category_id, category_name, date_modified) VALUES ('$categoryID', '$categoryName', '$dateModified')")
                    or die($database->error);

                $_SESSION['message'] = "Book category added successfully!";
                $_SESSION['msg_type'] = "success";
            } catch (mysqli_sql_exception $e) {
                // Handle the MySQLi SQL exception for duplicate entry
                if ($e->getCode() == 1062) { // Error code for duplicate entry
                    $_SESSION['message'] = " Book category with the same ID already exists.";
                    $_SESSION['msg_type'] = "danger";
                } else {
                    throw $e; // Re-throw the exception if it's not a duplicate entry error
                }
            }
        }
        // header("Location: {$_SERVER['PHP_SELF']}");
        header("Location: index.php?message=Book category added successfully!");
        exit();
    }
}
function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
// Function to validate Category ID format
function validate_category_id($categoryID)
{
    return preg_match('/^C\d{3}$/', $categoryID);
}