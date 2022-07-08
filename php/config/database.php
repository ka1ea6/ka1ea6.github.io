<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'Kaleab');
// define('DB_PASS', '4KW4q=LXbZls6und');
define('DB_PASS', 'helloworld');
define('DB_NAME', 'products');
 
// Create connection
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Check connection
if($conn -> connect_error){
    die('Connection Failed' . $conn -> connect_error);
}
