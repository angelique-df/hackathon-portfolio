<main class="dashboard-main">
<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hackathon2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $visitstmt = $conn->prepare("SELECT * FROM visits");
    $visitstmt->execute();

    $visitinfo = $visitstmt->fetchAll();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

function get_user_links($user){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "hackathon2";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        $linksstmt = $conn->prepare("SELECT link_url FROM links WHERE user_id = :id");
        $linksstmt->execute([
            ':id' => $user
        ]);
    
        $linksinfo = $linksstmt->fetchColumn();
    
        return $linksinfo;
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}

?>
    <div class="container">
        <section>
            <h2>Analytics</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Source</th>
                        <th>Durée</th>
                        <th>Lien</th>
                    </tr>
                </thead>
                <tbody>

<?php foreach ($visitinfo as $visit){ ?>
    <tr>
        <td><?= $visit['id'] ?></td>
        <td><?= $visit['entry_date'] ?></td>
        <td><?= $visit['referrer'] ?></td>
        <td><?= strtotime($visit['exit_date']) - strtotime($visit['entry_date']) .'s' ?></td>
        <?php  ?>
        <td>
            <ul>
            <li>
            <?php
                $t = get_user_links($visit['visitor']);
                echo $t;
            ?>
            </li>
            </ul>
        </td>
    </tr>
<?php } ?>
                    
                </tbody>
            </table>
        </section>
    </div>

    <div class="container">
        <section>
            <h2>Boîte de réception</h2>
            <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>E-mail</th>
                            <th>Téléphone</th>
                            <th>Message</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>yoyo</td>
                            <td>totototo</td>
                            <td>totototo</td>
                            <td>totototo</td>
                            <td>totototototototototototototototototototototototototototototototototototototototototototototototototototototototo</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
</main>