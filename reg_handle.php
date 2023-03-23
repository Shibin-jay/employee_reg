<?php

/**
 * File name: reg_handle.php
 * PHP script to handle the registration of employees.
 * PHP version 8.2.3
 *
 * @category PHP Session
 * @package  CodilarProjects
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.example.com/docs/auth
 * @author   Shibin <shibin.s@codilar.com>
 */

// Load the Dotenv library
require_once realpath(__DIR__ . "/vendor/autoload.php");

// Load the environment variables from the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Try to retrieve the value of one of the variables defined in the .env file
$host = $_ENV["DB_HOST"];
$user = $_ENV["DB_USERNAME"];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("INSERT INTO employeeDetails(fname, lname, email, phone, dept) VALUES (?,?,?,?,?)");

    // $id = uniqid();
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phNum'];
    $dept = $_POST['department'];

    $sql->bindParam(1, $fname);
    $sql->bindParam(2, $lname);
    $sql->bindParam(3, $email);
    $sql->bindParam(4, $phone);
    $sql->bindParam(5, $dept);

    if ($sql->execute()) {
        header("Location: table.php");
        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql->errorInfo()[2];
    }
    $sql->closeCursor();
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
