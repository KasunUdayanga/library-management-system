var updateForm = document.getElementById("updateForm");

updateForm.style.display = "none";

$('.delete-btn').on('click', function () {
    var catId = $(this).attr('data-catid');

    document.getElementById("deleteCatId").value = catId;


});

$('.edit-btn').on('click', function () {
    var catId = $(this).attr('data-catid');

    if (updateForm.style.display === "none") {
        updateForm.style.display = "block";

    } else {
        updateForm.style.display = "none";

    }
    getCatData(catId);


});

function getCatData(catId) {

    fetch('category_add.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `catId=${catId}`
    })
        .then(response => response.json())
        .then(data => {
            if (!data.available) {
                var catData = data.data;


                document.getElementById('categoryID').value = catData.category_id;
                document.getElementById('categoryName').value = catData.category_Name;
                document.getElementById("originalCategoryID").value = catData.category_id;



            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}