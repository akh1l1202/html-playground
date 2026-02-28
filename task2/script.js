const totalSeats = 500;
let registered = 375;
let remaining = totalSeats - registered;

document.getElementById('remainingSeats').textContent =
    'Remaining Seats: ' + remaining;

if (remaining > 0) {
    document.getElementById('status').textContent = 'Buy your tickets now!';
} else {
    document.getElementById('status').textContent = 'Sorry, seats are over.';
}

let eventCategory = "Technical";
let categoryMessage = "";
switch (eventCategory) {
    case "Technical":
        categoryMessage = "This is a Technical event focusing on innovation and technology.";
        break;

    case "Cultural":
        categoryMessage = "This is a Cultural event celebrating art, music, and creativity.";
        break;

    case "Sports":
        categoryMessage = "This is a Sports event promoting fitness and teamwork.";
        break;

    default:
        categoryMessage = "Event category not specified.";
}

const categoryPara = document.createElement("p");
categoryPara.textContent = categoryMessage;
categoryPara.style.textAlign = "center";

document.body.appendChild(categoryPara);