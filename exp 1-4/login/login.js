document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let username = document.getElementById("username").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let userError = document.getElementById("userError");
    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");
    let resultImage = document.getElementById("resultImage");
    let userPattern = /^[A-Za-z]{3,}$/;
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,10}$/;
    let passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    userError.textContent = "";
    emailError.textContent = "";
    passwordError.textContent = "";
    resultImage.style.display = "none";

    let valid = true;
    if (username === "") {
        userError.textContent = "Username is required";
        valid = false;
    }
    if (email === "") {
        emailError.textContent = "Email is required";
        valid = false;
    }
    if (password === "") {
        passwordError.textContent = "Password is required";
        valid = false;
    }

    if (username !== "" && !userPattern.test(username)) {
        userError.textContent = "Enter valid username";
        valid = false;
    }
    if (email !== "" && !emailPattern.test(email)) {
        emailError.textContent = "Enter valid email";
        valid = false;
    }
    if (password !== "" && !passwordPattern.test(password)) {
        passwordError.textContent =
            "Password must be 8+ chars, 1 uppercase, 1 digit & 1 special char";
        valid = false;
    }

    if (!valid) {
        resultImage.src = "sadcat.jpeg";
        resultImage.style.display = "block";
        return;
    }

    resultImage.src = "happycat.gif";
    resultImage.style.display = "block";

    alert("Login successful! Press OK to redirect");

    setTimeout(function () {
        window.location.href = "../task5/navigation.html";
    }, 4000);
});

document.querySelectorAll("input").forEach(function (input) {
    input.addEventListener("input", function () {
        document.getElementById("resultImage").style.display = "none";
    });
});