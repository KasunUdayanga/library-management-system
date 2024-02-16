var updateForm = document.getElementById("updateForm");

updateForm.style.display = "none";

$('.delete-btn').on('click', function () {
    var bookId = $(this).attr('data-bookId');

    document.getElementById("deleteUserId").value = bookId;


});

$('.edit-btn').on('click', function () {
    var bookId = $(this).attr('data-bookId');
    console.log("sd", bookId);

    if (updateForm.style.display === "none") {
        updateForm.style.display = "block";

    } else {
        updateForm.style.display = "none";

    }
    getCatData(bookId);


});

function getCatData(catId) {

    fetch('assets/php/processbook.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `bookId=${catId}`
    })
        .then(response => response.json())
        .then(data => {
            if (!data.available) {
                var catData = data.data;


                document.getElementById('book_id').value = catData.book_id;
                document.getElementById('book_name').value = catData.book_name;
                document.getElementById("book_category").value = catData.category_id;



            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}