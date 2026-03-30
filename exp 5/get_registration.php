<?php
$name = htmlspecialchars($_GET['student_name']);
$email = htmlspecialchars($_GET['email']);
$roll = htmlspecialchars($_GET['roll']);
$event = htmlspecialchars($_GET['event']);
$gender = isset($_GET['gender']) ? $_GET['gender'] : "Not Selected";
$skills = isset($_GET['skills']) ? $_GET['skills'] : [];

echo "<h2>Event Registration Details (GET Method)</h2>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Email:</strong> $email</p>";
echo "<p><strong>Roll Number:</strong> $roll</p>";
echo "<p><strong>Event:</strong> $event</p>";
echo "<p><strong>Gender:</strong> $gender</p>";

echo "<p><strong>Skills:</strong> ";
echo !empty($skills) ? implode(", ", $skills) : "None";
echo "</p>";
?>