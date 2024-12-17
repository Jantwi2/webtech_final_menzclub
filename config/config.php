<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'menzclub';

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    echo 'Error';
} 

?>