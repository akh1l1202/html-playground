let menuLinks = document.querySelectorAll(".nav-bar a");
let display = document.getElementById("clickedPage");

for (let i=0; i<menuLinks.length; i++) {
    menuLinks[i].addEventListener("mouseover", function () {
        this.style.backgroundColor = "#cce";
    });
    menuLinks[i].addEventListener("mouseout", function () {
        this.style.backgroundColor = "";
    });
    menuLinks[i].addEventListener("click", function (event) {
        event.preventDefault();
        let link = this.href;
        display.textContent = "Redirecting to: " + this.textContent + " ...";

        setTimeout(function () {
            window.location.href = link;
        }, 2000);
    });
}