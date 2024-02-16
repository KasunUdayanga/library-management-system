var updateForm = document.getElementById("updateForm");

updateForm.style.display = "none";

$('.delete-btn').on('click', function () {
    var fineId = $(this).attr('data-fineid');

    document.getElementById("deleteUserId").value = fineId;
    console.log("sd",fineId);


});

$('.edit-btn').on('click', function () {
    var fineId = $(this).attr('data-fineid');
    if (updateForm.style.display === "none") {
        updateForm.style.display = "block";

    } else {
        updateForm.style.display = "none";

    }

    
    
    getUserData(fineId);


});

function getUserData(userId) {

    fetch('assets/php/borrow_process.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `borrowID=${userId}`
    })
        .then(response => response.json())
        .then(data => {
            if (!data.available) {
                var userData = data.data;

                document.getElementById('borrow_id').value = userData.borrow_id;
                document.getElementById('book_id').value = userData.book_id;
                document.getElementById('member_id').value = userData.member_id;
                document.getElementById('borrow_status').value = userData.borrow_status;



            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}