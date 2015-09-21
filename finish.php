<?php
    include ('includes/html_header.php');
    include 'includes/functions.php';
    
    if (isset($_POST['stand'])){
        $_SESSION['dealer'][] = drawRandomCard($deck);

        ?>    
        <h2>Dealer</h2>

        <?php

        echo displayDealer() . "<br />";

        echo "The value of your hand is " . calculateHandValue($card_values_dealer); 

        ?>

        <h2>Player</h2>

        <?php

        echo displayPlayer() . "<br />";

        echo "The value of your hand is " . calculateHandValue($card_values_player);
        
        
    }
?>

<form method="post" action="index.php">
    <input type="hidden" name="startOver" />
    <button type="submit">START OVER</button>
</form>
<?php 
    include('includes/html_footer.php');
?>


