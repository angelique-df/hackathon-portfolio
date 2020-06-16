<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hackathon2";

echo '<pre>';
print_r($_POST);
echo '</pre>';
echo '<pre>';
print_r($_COOKIE);
echo '</pre>';

if( isset($_POST['exitdate']) && isset($_COOKIE['uniqueId']) ){
    
    $visitor = $_COOKIE['uniqueId'];

    $exitdate = $_POST['exitdate'];
    $exitdate = date('Y-m-d H:i:s', $exitdate);
    echo gettype($exitdate);

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE visits SET exit_date = :exit_date WHERE visitor = :visitor");
        $stmt->execute([
            'visitor' => $visitor,
            'exit_date' => $exitdate
            ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}