<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hackathon2";

echo '<pre>';
print_r($_POST);
echo '</pre>';

if( isset($_POST['entrydate']) && isset($_POST['entrydate']) && isset($_POST['userid'])){
    
    $visitor = $_POST['userid'];
    $timestamp = $_POST['entrydate'];
    $timestamp = date('Y-m-d H:i:s', $timestamp);
    echo $timestamp;

    $referrer = $_POST['referrer'];
    echo $referrer;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO visits (visitor, entry_date, exit_date, referrer) VALUES (:visitor, :entry_date, :exit_date, :referrer)");
        $stmt->execute([
            'visitor' => $visitor,
            'entry_date' => $timestamp,
            'exit_date' => NULL,
            'referrer' => $referrer
            ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}