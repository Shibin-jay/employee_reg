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
    
    
    $email = $_POST['email'];
    $phone = $_POST['phNum'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dept = $_POST['department'];
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM employeeDetails WHERE email = ?");
    $stmt_check->execute([$email]);
    $emailCount = $stmt_check->fetchColumn();
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM employeeDetails WHERE phone = ?");
    $stmt_check->execute([$phone]);
    $phoneCount = $stmt_check->fetchColumn();
    
    if ($emailCount>0){
        echo "<script> alert('email already exists, please provide alternative Email')</script>";
        header("Location:../");
    }
    elseif ($phoneCount > 0){
        echo "<script> alert('Phone number already exists, please provide alternative number')</script>";
    }
    else{
        try{
            $sql = $conn->prepare("INSERT INTO employeeDetails(fname, lname, email, phone, dept) VALUES (?,?,?,?,?)");
            $sql->bindParam(1, $fname);
            $sql->bindParam(2, $lname);
            $sql->bindParam(3, $email);
            $sql->bindParam(4, $phone);
            $sql->bindParam(5, $dept);
            $sql->execute();
            header('Location: table.php');
            $sql->closeCursor();
        }
        catch (PDOException $e) {
            echo "Error". $e->getMessage();
        }
    }
       
    $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
