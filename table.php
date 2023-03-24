<?php

/**
 * File name: table.php
 * PHP script to view all employee details.
 * PHP version 8.2.3
 *
 * @category PHP Session
 * @package  CodilarProjects
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.example.com/docs/auth
 * @author   Shibin <shibin.s@codilar.com>
 */

session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("location: ../");
    clearstatcache();
}
require_once realpath(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->query("SELECT * FROM employeeDetails");

    echo "<table>";
    echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Department</th><th>Action</th></tr>";
    while ($row = $sql->fetch()) {
        echo "<tr>
        <td>" . $row['fname'] . "</td>
        <td>" . $row['lname'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['phone'] . "</td>
        <td>" . $row['dept'] . "</td>
        <td>
        <a class='editBtn' href='edit.php?id=" . $row['id'] . "'>Edit</a>
        <a class='deleteBtn' onclick='return confirm('are you sure?')' href ='delete.php?id=" . $row['id'] . "'>Delete</a> 
        </td></tr>";
    }
    echo "</table>";

    $sql->closeCursor();
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Table</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<body>
    
</body>
</html>
