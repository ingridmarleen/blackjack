<?php
session_start();

$action = isset($_POST["do"]) ? $_POST["do"] : null;
            
switch($action){
    case "START":
        
        include_once ('includes/play.php');

    break;

    // get new cards and recalculate
    case "HIT":
        
        include_once ('includes/functions.php');
        
        $_SESSION['player'][] = drawRandomCard($deck);
        $handValuePlayer = calculateHandValue(array_column($_SESSION['player'], 'value'));
        
        include_once ('includes/play.php');
        
        if ($handValuePlayer >= 21){
            include_once('includes/finish.php'); 
        }

    break;

    // player stands
    case "STAND":
        
        include_once ('includes/functions.php');
        
        while ($handValueDealer < 17){
            $_SESSION['dealer'][] = drawRandomCard($deck);
            $handValueDealer = calculateHandValue(array_column($_SESSION['dealer'], 'value'));
        }
        
        include_once ('includes/play.php');
        
        include_once('includes/finish.php');

    break;

    // player wants to start over
    case "START OVER":
        session_destroy();
        include_once ('includes/start.php');                

    break;

    default:
        include_once ('includes/start.php');

    break;
}



