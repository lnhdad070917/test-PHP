<?php
require_once 'config.php';

$familyId = $_GET['id'];

$sql = "SELECT * FROM families WHERE id = $familyId";
$result = $conn->query($sql);
$family = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $parent_id = $_POST['parent_id'] ?: 'NULL';

    $name = $conn->real_escape_string($name);
    $gender = $conn->real_escape_string($gender);

    $sql = "UPDATE families SET name = '$name', gender = '$gender', parent_id = $parent_id WHERE id = $familyId";
    $conn->query($sql);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Family</title>
</head>

<body>

    <h2>Edit Family</h2>

    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $family['name'] ?>" required>
        <br><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?= $family['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $family['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
        </select>
        <br><br>
        <label for="parent_id">Parent ID:</label>
        <input type="number" id="parent_id" name="parent_id" value="<?= $family['parent_id'] ?>">
        <br><br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>