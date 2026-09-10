<?php
$conn = new mysqli("localhost", "root", "", "charitale");
if ($conn->connect_error) { die(json_encode(["error" => "Connection failed"])); }

// 1. Ambil Grand Total
$totalQuery = $conn->query("SELECT SUM(amount) as grand_total FROM donations");
$grandTotal = $totalQuery->fetch_assoc()['grand_total'] ?? 0;

// 2. Ambil Leaderboard Individu (Top 10)
$leaderboardQuery = $conn->query("SELECT name, angkatan, SUM(amount) as total_amount FROM donations GROUP BY name, angkatan ORDER BY total_amount DESC LIMIT 10");
$leaderboard = [];
while($row = $leaderboardQuery->fetch_assoc()) { $leaderboard[] = $row; }

// 3. Ambil Race Antar Angkatan
$angkatanQuery = $conn->query("SELECT angkatan, SUM(amount) as total_amount FROM donations GROUP BY angkatan ORDER BY total_amount DESC");
$angkatanRace = [];
while($row = $angkatanQuery->fetch_assoc()) { $angkatanRace[] = $row; }

// Kembalikan semua data dalam format JSON
echo json_encode([
    "grand_total" => $grandTotal,
    "leaderboard" => $leaderboard,
    "angkatan_race" => $angkatanRace
]);
$conn->close();
?>