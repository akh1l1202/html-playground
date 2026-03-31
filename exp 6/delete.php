<?php
include "db.php";

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM students WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully!";
    } else {
        echo "Delete failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
</head>
<body>

<h2>Delete Student Record</h2>

<form method="post">
    Enter Student ID:
    <input type="number" name="id" required>
    <input type="submit" name="delete" value="Delete">
</form>

</body>
</html>