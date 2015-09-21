<?php
    session_start();       
    /* ==================================================
     * Constants
     * =============================================== */
    
    define('DEALER_STAND_AT', 17);
    define('PLAYER_STAND_AT', 21);

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

    $deck = getCardDeck();
    
    
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

        $return_value = array('display' => $suit.$card,
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
        
    function calculateHandValue($card_values) {

	$return_value = 0; 
	$aces = 0;

	foreach($card_values as $key => $value) {
            
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
        
    function displayDealer(){
        
        $dealer_cards = array_column($_SESSION['dealer'], 'display');
        
        foreach ($dealer_cards as $dealer_display){
        echo $dealer_display . " ";
        }
    }

    function displayPlayer(){
        $player_cards = array_column($_SESSION['player'], 'display');

        foreach ($player_cards as $player_display){
        echo $player_display . " ";
        }
    }
	
    if(isset($_SESSION)){
        $card_values_dealer = array_column($_SESSION['dealer'], 'value');
        $card_values_player = array_column($_SESSION['player'], 'value');
        $handValueDealer = calculateHandValue($card_values_dealer);
        $handValuePlayer = calculateHandValue($card_values_player);
    }
    
    // Compare value $dealer and $player and declare winner
    /* if handvalue player > handvalue dealer !& > 21 -> player wins.
     * if handvalue dealer > handvalue player !& > 21 -> dealer wins.
     * if dealer and player have 21 -> dealer wins.
     */
    //test
    
?>