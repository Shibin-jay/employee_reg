<?php

/**
 * File name: reg.php
 * PHP script to register employee.
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

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Details</title>
    <link rel="stylesheet" href="css/regForm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
        <div class="myform">
            <form id="register" class="p-3 col-lg-6" method="post" action="reg_handle.php" >
                <div class="mb-3">
                  <label for="email" class="form-label">Email address :</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                  <p id="emailValidateMsg"></p> <!-- Add this line -->
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">First Name :</label>
                    <input type="text" class="form-control" id="fname" required name="fname" >
                    <p id="FnameMsg"> </p>
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Last Name :</label>
                  <input type="text" class="form-control" id="lname" required name="lname" aria-describedby="nameHelp">
                  <p id="lnameMsg"></p>
                </div>
                <div class="mb-3">
                    <label for="phNum" class="form-label">Phone number :</label>
                    <input type="text" class="form-control" id="phNum" name="phNum">
                    <p id="numMsg"></p>
                </div>
                <div class="mb-3">
                  <label for="department" class="form-label">Department :</label>
                  <input type="text" class="form-control" required id="department" name="department">
                </div>
                <button type="submit" class="btn btn-primary mx-2">Submit</button>
                <button type="reset" class="btn btn-danger mx-2">Reset</button>
                <a class="text-white " id="viewBtn" href="table.php">View all</a>
                <a class="text-white " id="logoutBtn" href="logout.php">Logout</a>
              </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  </body>
</html>