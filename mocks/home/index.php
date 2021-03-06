<?php
    require_once '../includes/config.php';
?>
<!-- 
    Author: Mike Newell © 2012
-->
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=0.5, minimum-scale=0.5 maximum-scale=1.0'" />
        
        <title>GSP Partner App || Person</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <link rel="stylesheet" type="text/css" href="../css/reset.css" />
        <link rel="stylesheet" type="text/css" href="../css/home/style.css.php" media="only screen and (-webkit-min-device-pixel-ratio: 1)" />
        <link rel="stylesheet" type="text/css" href="../css/home/retina.css" media="only screen and (-webkit-min-device-pixel-ratio: 2)" />
    </head>
    <body>
        <div id="wrap">
            <section>
                <form action="#" autocomplete="on">
                    <fieldset id="email">
                        <input type="text" name="search" placeholder="Name or email of the person you're searching for..." autocomplete="on" value="<?php echo $email; ?>" required>
                    </fieldset>
                    <fieldset id="submit">
                        <input type="submit">
                    </fieldset>
                </form>
            </section>
        </div>
        <?php include_once '../includes/scripts.php'; ?>
    </body>
</html>