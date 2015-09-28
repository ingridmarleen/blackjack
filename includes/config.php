<?php

    if(!isset($finish)){

?>
        <form method="post" action="play.php">
            <input type="submit" name="do" value="HIT" />

            <input type="submit" name="do" value="STAND" />

            <input type="submit" name="do" value="START OVER" />

        </form>

<?php
        
    }
    else{

?>

        <form method="post" action="index.php">
            <input type="hidden" name="startOver" />
            <button type="submit">START OVER</button>
        </form>

<?php

    }
    
?>



