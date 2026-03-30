<?php
$name = htmlspecialchars($_REQUEST['student_name']);
$email = htmlspecialchars($_REQUEST['email']);
$roll = htmlspecialchars($_REQUEST['roll']);
$event = htmlspecialchars($_REQUEST['event']);
$gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : "Not Selected";
$skills = isset($_REQUEST['skills']) ? $_REQUEST['skills'] : [];

echo "<h2>Event Registration Details (REQUEST Method)</h2>";
echo "<p><strong>Name:</strong> $name</p>";
echo "<p><strong>Email:</strong> $email</p>";
echo "<p><strong>Roll Number:</strong> $roll</p>";
echo "<p><strong>Event:</strong> $event</p>";
echo "<p><strong>Gender:</strong> $gender</p>";

echo "<p><strong>Skills:</strong> ";
echo !empty($skills) ? implode(", ", $skills) : "None";
echo "</p>";
?>