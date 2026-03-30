<?php
$name = htmlspecialchars($_POST['student_name']);
$email = htmlspecialchars($_POST['email']);
$roll = htmlspecialchars($_POST['roll']);
$event = htmlspecialchars($_POST['event']);
$gender = isset($_POST['gender']) ? $_POST['gender'] : "Not Selected";
$skills = isset($_POST['skills']) ? $_POST['skills'] : [];

if (empty($name) || empty($email) || empty($roll)) {
    echo "<h3>Error: All mandatory fields must be filled.</h3>";
    exit();
}

if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    echo "<h3>Error: Invalid email format.</h3>";
    exit();
}

echo "<h2>Event Registration Details</h2>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Email:</strong> $email</p>";
echo "<p><strong>Roll Number:</strong> $roll</p>";
echo "<p><strong>Event:</strong> $event</p>";
echo "<p><strong>Gender:</strong> $gender</p>";

echo "<p><strong>Skills:</strong> ";
if (!empty($skills)) {
    echo implode(", ", $skills);
} else {
    echo "None";
}
echo "</p>";
?>