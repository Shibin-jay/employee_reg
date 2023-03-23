<?php

/**
 * File name: index.php
 * PHP script for admin login.
 * PHP version 8.2.3
 *
 * @category PHP Session
 * @package  CodilarProjects
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.example.com/docs/auth
 * @author   Shibin <shibin.s@codilar.com>
 */

session_start();
if (isset($_SESSION['loggedIn'])) {
    header("location: reg.php");
    clearstatcache();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2 class="login-title">Log in</h2>
  
        <form class="login-form" method="post" action="login.php" >
          <div>
            <label for="email">Email </label>
            <input
              id="email"
              type="email"
              placeholder="me@example.com"
              name="email"
              required
            />
          </div>
          <div>
            <label for="password">Password </label>
            <input
              id="password"
              type="password"
              placeholder="password"
              name="password"
              required
            />
          </div>
          <button class="btn btn--form" type="submit" >
            Log in
          </button>
        </form>
      </div>
</body>
</html>
