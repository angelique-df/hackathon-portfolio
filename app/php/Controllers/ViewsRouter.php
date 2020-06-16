<?php

function include_view()
{
    //store URI request in a variable
    $request = $_SERVER["REQUEST_URI"];

    //include view according to requested URI
    switch ($request) {
        case "":
        case "/":
            require("./app/php/Views/Home.php");
        break;
        case "/hackathon":
        case "/hackathon/":
            require("./app/php/Views/Dashboard.php");
            break;     
        default:
            echo "404";
            break;
    }
}
include_view();
