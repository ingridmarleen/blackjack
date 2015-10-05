<?php
    if($handValuePlayer > 21){
        echo "<h1> Bust, You lose! </h1>";
    }
    elseif($handValueDealer == 21){
        echo "<h1> BLACKJACK for dealer! You lose! </h1>";
    }
    elseif($handValuePlayer == 21 && $handValueDealer != 21){
        echo "<h1> BLACKJACK! You win!! </h1>";
    }
    elseif($handValuePlayer == 21 && $handValueDealer == 21){
        echo "<h1> Both BLACKJACK, you lose! </h1>";
    }
    elseif($handValuePlayer > 21 && $handValueDealer > 21){
        echo "<h1> Both bust! You lose! </h1>";
    }
    elseif($handValueDealer > $handValuePlayer && $handValueDealer <= 21){
        echo "<h1> You lose!! </h1>";
    }
    elseif($handValuePlayer == $handValueDealer){
        echo "<h1> Stand-off, you lose! </h1>";
    }
    else{
        echo "<h1> You win! </h1>";
    }
    
    $finish=1
?>