<?php
$conn = new mysqli("localhost", "root", "", "charitale");

if ($conn->connect_error) { die(json_encode(["error" => "Connection failed"])); }

// Fetch Total Global Donations
$totalQuery = $conn->query("SELECT SUM(amount) as grand_total FROM donations");
$grandTotal = $totalQuery->fetch_assoc()['grand_total'] ?? 0;

// Aggregate by Name and Angkatan for Leaderboard
$leaderboardQuery = $conn->query("
    SELECT name, angkatan, SUM(amount) as total_amount 
    FROM donations 
    GROUP BY name, angkatan 
    ORDER BY total_amount DESC 
    LIMIT 10
");

$leaderboard = [];
while($row = $leaderboardQuery->fetch_assoc()) {
    $leaderboard[] = $row;
}

echo json_encode([
    "grand_total" => $grandTotal,
    "leaderboard" => $leaderboard
]);

$conn->close();
?>