var updateForm = document.getElementById("updateForm");

updateForm.style.display = "none";

$('.delete-btn').on('click', function () {
    var userId = $(this).attr('data-userid');

    document.getElementById("deletememberId").value = userId;


});

$('.edit-btn').on('click', function () {
    var memberId = $(this).attr('data-userid');
    if (updateForm.style.display === "none") {
        updateForm.style.display = "block";

    } else {
        updateForm.style.display = "none";

    }
    getMemberData(memberId);


});

function getMemberData(memberId) {

    fetch('assets/php/lib-members.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `member_id=${memberId}`
    })
        .then(response => response.json())
        .then(data => {
            if (!data.available) {
                var membeData = data.data;

                document.getElementById('firstName').value = membeData.first_name;
                document.getElementById('lastName').value = membeData.last_name;
                document.getElementById('email').value = membeData.email;

                var birthday = membeData.birthday; 

                var parts = birthday.split('/'); 
                var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];
                document.getElementById('birthday').value = formattedDate;
                document.getElementById('memberId').value = membeData.member_id;
                document.getElementById("editmemberId").value = membeData.memberId;



            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function updateUser() {

    if (emailValidation == 0 && userIdValidation == 0 && userIdValidation == 0 && passwordValidation == 0) {

        const firstName = document.getElementById('firstName').value;
        const lastName = document.getElementById('lastName').value;
        const username = document.getElementById('username').value;
        const userId = document.getElementById('userId').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const prepassword = document.getElementById('pre_user_id').value;


        const formData = {
            pre_user_id: prepassword,
            user_id: userId,
            email: email,
            firstname: firstName,
            lastlame: lastName,
            username: username,
            password: password
        };
        // Send AJAX request
        console.log("sd");
        $.ajax({
            url: "assets/php/user.php",
            type: "PUT",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Check the response from the server
                if (response.success) {
                    // User details updated successfully
                    alert("User details updated successfully");
                    // Redirect to index.php or perform any other action as needed
                    window.location.href = "index.php";
                } else {
                    // Error updating user details
                    alert("Error updating user details");
                }
            },
            error: function (xhr, status, error) {
                // Log any errors to the console
                console.error(xhr.responseText);
                // Display an error message to the user
                alert("An error occurred while processing your request. Please try again later.");
            }
        });

    }
}


