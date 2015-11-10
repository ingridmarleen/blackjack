<?php
    
include_once ('includes/html_header.php');

include_once ('includes/functions.php');

?>

<h2>Dealer</h2>

<?php

echo displayDealer() . "<br />";

echo "The value of dealers hand is " . $handValueDealer; 

?>

<h2>Player</h2>

<?php

echo displayPlayer() . "<br />";

echo "The value of your hand is " . $handValuePlayer;
    
include_once ('includes/actions.php');
    
include_once ('includes/html_footer.php');
    
?>  