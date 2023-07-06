<?php
require_once 'config.php';

$familyId = $_GET['id'];

$sql = "DELETE FROM families WHERE id = $familyId";
$conn->query($sql);

header('Location: index.php');
exit;