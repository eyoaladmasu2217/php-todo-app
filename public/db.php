<?php
// filepath: c:\xampp\htdocs\php\todo-app\public\db.php
function connectDB() {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'todo_app'; // Change to your database name

    $mysqli = new mysqli($host, $user, $pass, $dbname);

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
    return $mysqli;
}
?>