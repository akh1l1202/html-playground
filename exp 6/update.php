<?php
include "db.php";

$student = null;

if (isset($_POST['fetch'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "Student not found!";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    $update_sql = "UPDATE students SET name='$name', email='$email', department='$department' WHERE id='$id'";

    if (mysqli_query($conn, $update_sql)) {
        echo "Record updated successfully!";
    } else {
        echo "Update failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
</head>
<body>

<h2>Update Student Record</h2>

<form method="post">
    Enter Student ID:
    <input type="number" name="id" required>
    <input type="submit" name="fetch" value="Fetch Record">
</form>

<br>

<?php if ($student) { ?>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
    <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br><br>
    <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br><br>
    <input type="text" name="department" value="<?php echo $student['department']; ?>" required><br><br>
    <input type="submit" name="update" value="Update">
</form>
<?php } ?>

</body>
</html>