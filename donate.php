<?php
$conn = new mysqli("localhost", "root", "", "charitale");

if ($conn->connect_error) { 
    die(json_encode(["success" => false, "error" => "Connection failed"])); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $angkatan = $conn->real_escape_string($_POST['angkatan']);
    $amount = intval($_POST['amount']);
    
    // Proses Upload Gambar
    $proof_image = "";
    if (isset($_FILES['proof']) && $_FILES['proof']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        // Buat folder uploads jika belum ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileTmpPath = $_FILES['proof']['tmp_name'];
        // Generate nama file unik agar tidak bentrok
        $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES['proof']['name']));
        $destPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $proof_image = $fileName;
        } else {
            die(json_encode(["success" => false, "error" => "Gagal mengunggah gambar."]));
        }
    }

    $stmt = $conn->prepare("INSERT INTO donations (name, angkatan, amount, proof_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $angkatan, $amount, $proof_image);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Database error."]);
    }
    $stmt->close();
}
$conn->close();
?>