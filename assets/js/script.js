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

function addFine() {
        document.getElementById("feature-content").innerHTML = "";

        featureTitle.textContent = "";

        $.get("fine.php", function (data) {
                $('#feature-content').html(data);
        });

}

function loadFineList() {
        document.getElementById("feature-content").innerHTML = "";

        featureTitle.textContent = "";

        $.get("fine_list.php", function (data) {
                $('#feature-content').html(data);
        });

}
