function validateForm() {
    let name = document.querySelector('input[name="student_name"]').value;
    let email = document.querySelector('input[name="email"]').value;
    let roll = document.querySelector('input[name="roll"]').value;

    if (name === "" || email === "" || roll === "") {
        alert("Please fill all mandatory fields!");
        return false;
    }

    if (!email.includes("@")) {
        alert("Please enter a valid email address!");
        return false;
    }

    return true;
}