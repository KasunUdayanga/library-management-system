<?php require_once "assets/php/processbook.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include Bootstrap, CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="assets/css/user-register.css" rel="stylesheet">

</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert <?= $_SESSION['message_type']; ?>" role="alert">
        <?= $_SESSION['message']; ?>
    </div>

    <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
<?php endif; ?>

<div class="container mt-5" style="width: 80%; margin: 0 auto;">
  <div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="card-body">
    <h2 class="card-title text-center mb-4"> Books Registration</h2>    
         
    
        <!-- Book Form -->
        <form id="bookForm"   method= "post" class="needs-validation" action="assets/php/processbook.php">
        <div class="mb-3">
            <label for="bookID"  class="form-label" >Book ID:</label>
            <input type="text" id="bookID" class="form-control" name="bookID" placeholder="Enter Book ID (e.g., B001)" required pattern="B\d{3}">
        </div>
        <div class="mb-3">  
            <label for="bookName"  class="form-label" >Book Name:</label>
            <input type="text" id="bookName" class="form-control"  name="bookName" placeholder="Enter Book Name" required>
        </div>
        <div class="mb-3">
            <label for="bookCategory" class="form-label" >category ID:</label>
            <input type="text" id="bookCategory" class="form-control" name="bookCategory" placeholder="Enter Book category ID (e.g., C001)" required pattern="C\d{3}">
        </div>
        <input type="hidden" name="pre_user_id" id="editUserId">
        <div class="d-grid gap-2"> 
            <button type="submit" class="btn btn-primary btn-block" name ="submit"  >Add Book</button>
        </div>
        </form>

        </div>
  </div>
</div>



</body>
</html>
