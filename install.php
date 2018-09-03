<?php
// reporting any error
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "classes/database.php";

$connection = new Database();
$connection->installing();

