<?php

/**
 * File name: delete.php
 * PHP script for deleting employee.
 * PHP version 8.2.3
 *
 * @category PHP Session
 * @package  CodilarProjects
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.example.com/docs/auth
 * @author   Shibin <shibin.s@codilar.com>
 */

require_once realpath(__DIR__ . "/vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV["DB_USERNAME"];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("DELETE FROM employeeDetails WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: table.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
