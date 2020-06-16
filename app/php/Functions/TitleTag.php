<?php

//define title tag for each view according to requested URI
function title_tag()
{

    //store URI request in a variable
    $request = $_SERVER['REQUEST_URI'];

    //title tag content
    $title_tag = " - Angélique Faye, Développeuse Web Frontend";
    $current_page = "";

    switch ($request) {
        case '';
        case '/';
            $current_page = "Accueil";
            break;

        case '/hackathon':
            $current_page = "Dashboard";
            break;
    }
    return $current_page . $title_tag;
}
$title_tag = title_tag();
