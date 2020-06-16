<?php

// find 10 countries in database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hackathon2";

echo '<pre>';
print_r($_POST);
echo '</pre>';

if( isset($_POST['referrer'])){
    
    $referrer = $_POST['referrer'];
    echo $referrer;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO visits (entry_date, exit_date, referrer) VALUES (:entry_date, :exit_date, :referrer)");
        $stmt->execute([
            'entry_date' => NULL,
            'exit_date' => NULL,
            'referrer' => $referrer
            ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;

}

