<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . './../Functions/TitleTag.php'; 
// require __DIR__ . './../Functions/href.php'; 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_tag ?></title>
    <!-- <link rel="stylesheet" href="./app/src/css/reset.css"> -->
    <link rel="stylesheet" href="./app/src/css/normalize.css">
    <link rel="stylesheet" href="./app/src/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet"> 
</head>

<body>
    <header>
        <h1 class="site-name"><a href="<?php href(); ?>">Angélique Faye</a></h1>
        <nav>
            <ul>
                <li><a href="#about">À propos</a></li>
                <li><a href="">GitHub</a></li>
                <li><a href="#contact-form">Contact</a></li>
            </ul>
        </nav>
    </header>
    <a href="#top"></a>