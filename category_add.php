<?php
// session_start();
include 'assets/php/config.php';

// Function to sanitize user inputs
function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to validate Category ID format
function validate_category_id($categoryID)
{
    return preg_match('/^C\d{3}$/', $categoryID);
}

// CRUD Operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['update'])) {
        // Update book category
        $originalCategoryID = sanitize_input($_POST['originalCategoryID']);
        $categoryID = sanitize_input($_POST['categoryID']);
        $categoryName = sanitize_input($_POST['categoryName']);
        $dateModified = date('Y-m-d H:i:s');

        // Validate Category ID format
        if (!validate_category_id($categoryID)) {
            $_SESSION['message'] = "Invalid Category ID format. Example: C001";
            $_SESSION['msg_type'] = "danger";
        } else {
            $database->query("UPDATE bookcategory SET category_id='$categoryID', category_name='$categoryName', date_modified='$dateModified' WHERE category_id='$originalCategoryID'")
                or die($database->error);

            $_SESSION['message'] = "Book category updated successfully!";
            $_SESSION['msg_type'] = "warning";
        }
        header("Location: index.php?message=Book category updated successfully!");
        exit();
    }
}

// Delete book category
if (isset($_POST['delete'])) {
    $categoryID = sanitize_input($_POST['cat_id']);
    $database->query("DELETE FROM bookcategory WHERE category_id='$categoryID'") or die($database->error);

    $_SESSION['message'] = "Book category deleted successfully!";
    $_SESSION['msg_type'] = "danger";
    header("Location: index.php?message=Book category deleted successfully!");
    exit();
}

// Edit book category - Populate form with existing data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['catId'])) {
    $catId = $_POST['catId'];

    $stmt = $database->prepare("SELECT * FROM bookcategory WHERE category_id = ?");
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
    echo json_encode(['available' => $available, 'data' => $cat]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Book Category Registration</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Bootstrap, CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


</head>

<body>
    <div class="container mt-5" style="width: 80%; margin: 0 auto;">
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-<?= $_SESSION['msg_type'] ?>" role="alert">
                        <?= $_SESSION['message'] ?>
                    </div>
                    <?php
                    // Clear the message after displaying
                    unset($_SESSION['message']);
                    unset($_SESSION['msg_type']);
                    ?>
                <?php endif; ?>

                <!-- action="assets/php/user.php" -->
                <form id="updateUserForm" action="book_insert.php" class="needs-validation" method="post">
                    <div class="mb-3">
                        <label for="categoryID" class="form-label">Category ID:</label>
                        <input type="text" class="form-control" id="categoryID" name="categoryID" value="<?= isset($editCategoryID) ? $editCategoryID : '' ?>" required>
                        <small class="error-message">
                            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add']) && !validate_category_id($_POST['categoryID'])) echo "Invalid Category ID format. Example: C001"; ?>
                        </small>
                    </div>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name:</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?= isset($editCategoryName) ? $editCategoryName : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-block" name="<?= isset($editCategoryID) ? 'update' : 'add' ?>">
                            <?= isset($editCategoryID) ? 'Update Category' : 'Add Category' ?>
                        </button>
                        <?php if (isset($editCategoryID)) : ?>
                            <input type="hidden" name="originalCategoryID" value="<?= $editCategoryID ?>">
                            <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger" style="margin-left: 10px;">Cancel</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>


</body>

</html>