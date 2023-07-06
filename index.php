<?php
require_once 'config.php';

$sql = "SELECT * FROM families";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Family Tree CRUD</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .button-group {
            display: flex;
            align-items: center;
        }

        .button-group .button {
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <h2>Family Tree</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Parent ID</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td>
                    <?= $row['id'] ?>
                </td>
                <td>
                    <?= $row['name'] ?>
                </td>
                <td>
                    <?= $row['gender'] ?>
                </td>
                <td>
                    <?= $row['parent_id'] ?>
                </td>
                <td class="button-group">
                    <a class="button" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="button" href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>

    <a href="add.php">Add Family</a>

</body>

</html>