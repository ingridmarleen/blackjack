<?php

if($handValuePlayer > 21){
    echo "<h1> Bust, You lose! </h1>";
}
elseif ($handValuePlayer == 21){
    while ($handValueDealer < 17){
            $_SESSION['dealer'][] = drawRandomCard($deck);
            $handValueDealer = calculateHandValue(array_column($_SESSION['dealer'], 'value'));
        }
    if($handValuePlayer == 21 && $handValueDealer == 21){
        echo "<h1> Stand-off </h1>";
    }
    elseif($_SESSION['dealer'][0]['value'][0] + $_SESSION['dealer'][0]['value'][1] == 21){
        echo "<h1> BLACKJACK dealer, you lose";
    }
    else {
        echo "<h1> You've won!</h1>";
    }

}
elseif($handValuePlayer > 21 && $handValueDealer > 21){
    echo "<h1> Both bust! You lose! </h1>";
}
elseif($handValueDealer > $handValuePlayer && $handValueDealer <= 21){
    echo "<h1> You lose!! </h1>";
}
elseif($handValuePlayer == $handValueDealer){
    echo "<h1> Stand-off </h1>";
}
else{
    echo "<h1> You've won! </h1>";
}

$finish=1;

