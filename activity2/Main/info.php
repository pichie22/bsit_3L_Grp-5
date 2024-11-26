<?php
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$db_host = '127.0.0.1';
$db_username = 'root';
$db_password = 'root';
$db_name = 'db_form';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

$firstname = $_POST['Firstname'];
$lastname = $_POST['Lastname'];
$email = $_POST['email'];
$country = $_POST['Region'];
$gender = $_POST['Gender'];
$phonenumber = $_POST['PhoneNumber'];

$query = "INSERT INTO tbl_form (Firstname, Lastname, email, Region, Gender, PhoneNumber) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssss", $firstname, $lastname, $email, $country, $gender, $phonenumber);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Data inserted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>