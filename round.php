<?php
    include ('includes/html_header.php');
    include ('includes/functions.php');

    // Player pushes hit: get a new card and calculate
    if(isset($_POST['hit'])){
        $_SESSION['player'][] = drawRandomCard($deck);
        $_SESSION['dealer'][] = drawRandomCard($deck);
    }
    
    ?>    
        <h2>Dealer</h2>

        <?php

        echo displayDealer() . "<br />";

        echo "The value of your hand is " . $handValueDealer; 

        ?>

        <h2>Player</h2>

        <?php

        echo displayPlayer() . "<br />";

        echo "The value of your hand is " . $handValuePlayer;

    include('includes/config.php');
    
    include('includes/html_footer.php');

?>

