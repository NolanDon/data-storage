<?php

include '../config.php';

$host = "127.0.0.1:3306";
$user = 'root';
$password = $dbpassword;
$dbname = 'vuedb';
$id = '';

// basic mysqli_connect will react the url to db, user, pw, and name of db
// here we assign it to a variable because we'll have to reuse it
$con = mysqli_connect($host, $user, $password, $dbname);

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

switch ($method) {
    case 'GET':
        $id = $_GET['id'];
        // returning all contacts if none its returning empty string / null
        $sql = "SELECT * FROM CONTACTS".($id ? " where id=$id" : '');
    break;
    case 'POST':
        $name = $POST['name']; // from our form in index.php
        $email = $POST['email']; // from our form in index.php
        $country = $POST['country']; // from our form in index.php
        $city = $POST['city']; // from our form in index.php
        $job = $POST['job']; // from our form in index.php
        $sql = "INSERT INTO CONTACTS(name, email, country, city, job) VALUES($name, $email, $country, $city, $job)";
        console.log('success');
    break;
}

// running sql statement
$result = mysqli_query($con, $sql); // takes in the connection info the request type

// die if SQL statement failed
if (!$result) {
    http_response_code(404);
    die(mysqli_error($con));
}

if ($method == 'GET') {
    if (!$id) { echo '[';
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            echo ($i > 0 ? ',' : '').json_encode(mysqli_fetch_object($result));
        }
        if (!$id) echo ']';
    } elseif ($method === 'POST') {
        echo json_encode($result);
    } else {
        echo mysqli_affected_rows($con);
    }
}

$con->close();
?>
