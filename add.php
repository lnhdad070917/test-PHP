<?php
require_once 'config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $parent_id = $_POST['parent_id'] ?: 'NULL';

    $name = $conn->real_escape_string($name);
    $gender = $conn->real_escape_string($gender);

    $sql = "INSERT INTO families (name, gender, parent_id) VALUES ('$name', '$gender', $parent_id)";
    $conn->query($sql);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Family</title>
</head>

<body>

    <h2>Add Family</h2>

    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <br><br>
        <label for="parent_id">Parent ID:</label>
        <input type="number" id="parent_id" name="parent_id">
        <br><br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>