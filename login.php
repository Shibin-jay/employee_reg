<?php

/**
 * File name: login.php
 * PHP script to authenticate admin.
 * PHP version 8.2.3
 *
 * @category PHP Session
 * @package  CodilarProjects
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.example.com/docs/auth
 * @author   Shibin <shibin.s@codilar.com>
 */

session_start();

require_once realpath(__DIR__ . "/vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$user = $_ENV['ADMIN_EMAIl'];
$password = $_ENV['ADMIN_PASSWORD'];
$currentUser = $_POST["email"];
$currentPassword = $_POST["password"];

if ($user == $currentUser && $password == $currentPassword) {
    $_SESSION['loggedIn'] = true;
    header("Location: reg.php");
} else {
    header("Location: index.php");
}
