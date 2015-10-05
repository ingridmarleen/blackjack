<?php
    session_start();  
    
    /* ===================================================
     * Deck functions
     * ================================================ */

    /**
     * This function creates a deck of cards to play with
     * @return Array The deck of cards
     */

    function getCardDeck () { 

        $cards = array(1 => 'A', 2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K');
        $deck = array(  'S' => $cards,
                        'H' => $cards,
                        'C' => $cards,
                        'D' => $cards);
        return $deck;
    }

    $_SESSION['deck'] = getCardDeck();
    $deck = $_SESSION['deck'];
    
    function drawRandomCard (&$deck) { 
        
        $suit = array_rand($deck);
        $card = array_rand($deck[$suit]);

        // Determine the face value of the card.
        // Face cards are worth 10
        if ($card >=10){
        $card_value = 10;
        }
        else {
            $card_value = $card;
        }
        $image = "$suit{$card}.png";
        $return_value = array('display' => "<img src='cards/$image'>",
                              'value' => $card_value);                
                            // returns a two element array showing a card's suit & face value

        unset($deck[$suit][$card]);

        return $return_value;
    }
    
        
    //To check values
    // $card = drawRandomCard($deck);
    // print_r($card);   
     
    /* ====================================================
     * Player functions
     * ================================================= */
         
    // Start a game
    
    
    function startGame() {
	// First game is two cards for each player
        
        $deck = getCardDeck();
        
        $dealer = array(drawRandomCard($deck), drawRandomCard($deck));
	$player = array(drawRandomCard($deck), drawRandomCard($deck));
	
	return array($dealer, $player, $deck); 
    }
    
    if(!isset($_SESSION['player'])){
        $_SESSION['player'] = startGame()[0];
        $_SESSION['dealer'] = startGame()[1];
    }
    else{
        null;
    }
    
    // check values:
    // $start = startGame();
    // var_dump($start);
     
    // calculate the value of the hand
    
    function calculateHandValue($card_values) {

	$return_value = 0; 
	$aces = 0;

	foreach($card_values as $value) {
            
            if($value != 1) {
                    $return_value = $return_value + $value;
            } else {
                    $aces++;
            }
	}

	//Special consideration for Aces
	for($i = 0; $i < $aces; $i++) {
            
            if (($return_value + 11) > 21){
                $return_value = $return_value + 1;
            }
            else {
                $return_value = $return_value + 11;
            }
	}

	return $return_value;
    }
    
    // display the dealers cards
    function displayDealer(){
        
        $dealer_cards = array_column($_SESSION['dealer'], 'display');
        
        foreach ($dealer_cards as $dealer_display){
        echo $dealer_display . " ";
        }
    }

    // display the players cards
    function displayPlayer(){
        $player_cards = array_column($_SESSION['player'], 'display');

        foreach ($player_cards as $player_display){
        echo $player_display . " ";
        }
    }
    
    $handValueDealer = calculateHandValue(array_column($_SESSION['dealer'], 'value'));
    $handValuePlayer = calculateHandValue(array_column($_SESSION['player'], 'value'));
    
    if ($handValueDealer >= 21 || $handValuePlayer >= 21){
        include_once('finish.php'); 
    }
                
    // actions
    $action = isset($_POST["do"]) ? $_POST["do"] : null;
            
    switch($action){
        // get new cards and recalculate
        case "HIT":
            $_SESSION['player'][] = drawRandomCard($deck);
            $handValuePlayer = calculateHandValue(array_column($_SESSION['player'], 'value'));

            if ($handValueDealer < 17){
                $_SESSION['dealer'][] = drawRandomCard($deck);
                $handValueDealer = calculateHandValue(array_column($_SESSION['dealer'], 'value'));
            }
            
            if ($handValueDealer >= 21 || $handValuePlayer >= 21){
                include_once('finish.php'); 
            }

        break;

        // player stands
        case "STAND":
            while ($handValueDealer < 17){
                $_SESSION['dealer'][] = drawRandomCard($deck);
                $handValueDealer = calculateHandValue(array_column($_SESSION['dealer'], 'value'));
            }
            include_once('finish.php');
                        
        break;

        // player wants to start over
        case "START OVER":
            unset($_SESSION['deck']);
            unset($_SESSION['dealer']);
            unset($_SESSION['player']);
            header("location: index.php");                
        
        break;
    }
    
?>