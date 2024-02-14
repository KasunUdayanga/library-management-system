//Side Bar Collapsed
const toggler = document.querySelector(".nav_button");
const navBar = document.querySelector(".navbar");
var topnavSearchElement = document.getElementById("top_nav-search");
var topNavProfElement = document.getElementById("navbarDropdown");
var featureTitle = document.getElementById("feature-title");



toggler.addEventListener("click", function () {
        //Sidebar collapsed in mobileview
        if (window.innerWidth <= 768) {
                document.querySelector("#sidebar").classList.toggle("collapsed");
                navBar.classList.toggle("collapsed");
                if (topnavSearchElement.style.display === "none") {
                        topnavSearchElement.style.display = "block";
                        topNavProfElement.style.display = "block";

                } else {
                        topnavSearchElement.style.display = "none";
                        topNavProfElement.style.display = "none";

                }




        } else {
                //Sidebar collapsed in desktopview

                document.querySelector("#sidebar").classList.toggle("collapsed");
                document.querySelector("#content").classList.toggle("collapsed");
        }

});

function loadDashboard() {
        document.getElementById("feature-content").innerHTML = "";
        featureTitle.textContent = "Dashboard";



}


function loadUserList() {
        document.getElementById("feature-content").innerHTML = "";

        featureTitle.textContent = "";

        $.get("users-list.php", function (data) {
                $('#feature-content').html(data);
        });

}


function getProfileDatails() {
        const username = document.getElementById('username').value;
      
      
        fetch('assets/php/user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `username=${username}`
        })
            .then(response => response.json())
            .then(data => {
                if (!data.available) {
                    var userData = data.data;
      
                    document.getElementById('firstName').value = userData.first_name;
                    document.getElementById('lastName').value = userData.last_name;
                    document.getElementById('email').value = userData.email;
                    document.getElementById('username').value = userData.username;
                    document.getElementById('userId').value = userData.user_id;
                    document.getElementById("editUserId").value = userData.userId;
      
      
      
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
      }
      