<?php
include "db.php";

if (isset($_POST['submit'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $dept  = $_POST['dept'];

    $sql = "INSERT INTO students (name, email, department)
            VALUES ('$name', '$email', '$dept')";

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Department: <input type="text" name="dept" required><br><br>
    <input type="submit" name="submit" value="Add Student">
</form>

</body>
</html>