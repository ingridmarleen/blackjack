<?php
    
    include('includes/html_header.php');

    include('includes/functions.php');

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

    
    include('includes/config.php');
    
    include('includes/html_footer.php');
    
?>  