<?php
if(isset($_SESSION)){
        //remove PHPSESSID from browser
        if (isset( $_COOKIE[PHPSESSID()])){
        setcookie(oldID(), "", time()-3600, "/" );
        //clear session from globals
        $_SESSION = array();
        //clear session from disk
        session_destroy();
        session_write_close();
        }
    }
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Blackjack!</title>
</head>
<body>
    <form method="post" action="play.php">
            <input type="hidden" name="do" value="start" />
            
    <h2>Welcome to Blackjack!</h2>
    To start a game, please click 
    <button type = 'submit'> START </button>
    </form>
</body>
</html>


