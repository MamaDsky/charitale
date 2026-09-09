<?php
// Database connection setup
$host = "localhost"; $user = "root"; $pass = ""; $db = "charitale";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) { die(json_encode(["success" => false, "error" => "Connection failed"])); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $angkatan = $conn->real_escape_string($_POST['angkatan']);
    $amount = intval($_POST['amount']);

    $stmt = $conn->prepare("INSERT INTO donations (name, angkatan, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $angkatan, $amount);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
    $stmt->close();
}
$conn->close();
?>