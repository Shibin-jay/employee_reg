<?php

/**
 * PHP script to perform logout
 *
 * @author Shibin <shibin.s@codilar.com>
 * @return void
 */

session_start();
session_destroy();
header("Location: login.php");
