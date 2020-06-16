<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hackathon2";

echo '<pre>';
print_r($_POST);
echo '</pre>';

if( isset($_POST['linksclicked']) ){
    
    $user_id = $_POST['userid'];
    $links = $_POST['linksclicked'];
    echo $links;
    echo gettype($links);

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO links (user_id, link_url) VALUES (:user_id, :link_url)");
        $stmt->execute([
            'user_id' => $user_id,
            'link_url' => $links
            ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;


}