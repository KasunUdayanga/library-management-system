<?php
require_once "assets/php/fine_process.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Include Bootstrap, CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="assets/css/user-register.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <title>Fine</title>
</head>
<body>




    <div class="container mt-5" style="width: 80%; margin: 0 auto;" id="updateForm">
    <?php if(isset($_SESSION['message'])): ?>
    <div class="alert <?=$_SESSION['message_type']; ?>" role="alert">
        <?= $_SESSION['message'] ?>
    </div>
    <?php unset($_SESSION['message'],$_SESSION['message_type']); ?>
<?php endif ;?>
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
           
                    <h2 class="card-title text-center mb-4">Add Fine details</h2>
               
                    <form action="assets/php/fine_process.php" method="POST" class="needs-validation" onsubmit="return validateForm()">

                    <div class="mb-3">
                    <label for="fine_id" class="form-label">Fine ID: </label>
                    <input type="text" class="form-control"id="fine_id" name="fine_id" placeholder="Enter Fine ID" value="<?= isset($fine_id) ? $fine_id : '' ?>" required autocomplete='off'>
                    </div>

                    <div class="mb-3">
                    <label for="book_id" class="form-label">Book ID: </label>
                    <input type="text" class="form-control" id="book_id" name="book_id" placeholder="Enter Book ID" value="<?= isset($book_id) ? $book_id : '' ?>" required autocomplete='off'>
                    </div>

                    <div class="mb-3">
                    <label for="member_id" class="form-label">Member ID: </label>
                    <input type="text" class="form-control" id="member_id" name="member_id"  placeholder="Enter Member ID" value="<?= isset($member_id) ? $member_id : '' ?>" required autocomplete='off'>
                    </div>

                    <div class="mb-3">
                    <label for="fine_amount" class="form-label">Fine Amount (LKR): </label>
                    <input type="text" class="form-control" id="fine_amount" name="fine_amount" placeholder="Enter Fine Amount (LKR)" value="<?= isset($fine_amount) ? $fine_amount : '' ?>" required autocomplete='off'>
                    </div>

                    <div class="mb-3">
                    <input type="datetime-local" hidden class="form-control" id="fine_date_modified" name="fine_date_modified" value="<?= date('Y-m-d\TH:i:s') ?>" required autocomplete='off'>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block" name="submit" >Submit</button>
                    </div>
                    </form>
            </div>

        </div>
    </div>


<script>
function validateForm() {
    // Get input values
    var fineId = document.getElementById("fine_id").value.trim();
    var bookId = document.getElementById("book_id").value.trim();
    var memberId = document.getElementById("member_id").value.trim();
    var fineAmount = document.getElementById("fine_amount").value.trim();
    var fineDateModified = document.getElementById("fine_date_modified").value.trim();

    // Check if any field is empty
    if (fineId === "" || bookId === "" || memberId === "" || fineAmount === "" || fineDateModified === "") {
        alert("Please fill in all fields");
        return false;
    }

    // Validate Fine ID format using a regular expression
    var fineIdRegex = /^F\d{3}$/;
    if (!fineIdRegex.test(fineId)) {
        alert("Invalid Fine ID format. It should start with 'F' followed by 3 digits (e.g., F001).");
        return false;
    }

    // Validate Book ID format using a regular expression
    var bookIdRegex = /^B\d{3}$/;
    if (!bookIdRegex.test(bookId)) {
        alert("Invalid Book ID format. It should start with 'B' followed by 3 digits (e.g., B001).");
        return false;
    }

    // Validate Member ID format using a regular expression
    var memberIdRegex = /^M\d{3}$/;
    if (!memberIdRegex.test(memberId)) {
        alert("Invalid Member ID format. It should start with 'M' followed by 3 digits (e.g., M001).");
        return false;
    }

    // Check if Fine Amount is a valid number and within the specified range
    if (isNaN(fineAmount) || fineAmount < 2 || fineAmount > 500) {
        alert("Fine amount must be a number between 2 and 500 LKR.");
        return false;
    }

    // If all validations pass, return true to submit the form
    return true;
}

function closeForm() {
    alert("Back to the Home page!");
    window.location.href = 'fine.php';
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
