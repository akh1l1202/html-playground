<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: gray;
        }
    </style>
</head>
<body>

<h2>Student Records</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
    </tr>

<?php
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['department']}</td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>