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
        
        <title>GSP Partner App || Partner App</title>
        
        <?php include_once '../includes/head.php'; ?>
        
        <!-- specific page box layout -->
        <link rel="stylesheet" type="text/css" href="../css/partner/style.css.php" media="only screen and (-webkit-min-device-pixel-ratio: 1)" />
        <link rel="stylesheet" type="text/css" href="../css/partner/retina.css" media="only screen and (-webkit-min-device-pixel-ratio: 2)" />
    </head>
    <body>
        <div id="wrap">
            
            <?php include_once '../includes/header.php'; ?>
            
            <section id="ajax">
                    
                <article>
                    
                    <div id="slideWindow">
                        <div id="slideContainer">
                            
                            <div class="slide slide1">
                                <h1>WELCOME <span>LEAH</span></h1>
                                <p>Should our next holiday party be at slims or sfmoma?</p>

                                <div id="patch"></div>

                                <h2><span id="logoDefault">GOODBY SILVERSTEIN</span> <span id="amp">&</span> <span id="logoFirstName">leah</span></h2>
                            </div>

                            <div class="slide slide2">
                                <h2>STEP TWO:</h2>
                                <p>Please select a size...</p>
                                <ul class="sizes">
                                    <li><a class="size small" href="#small">Small</a></li>
                                    <li><a class="size medium" href="#medium">Medium</a></li>
                                    <li><a class="size large" href="#large">Large</a></li>
                                    <li><a class="size extraLarge" href="#extraLarge">Extra Large</a></li>
                                </ul>
                                <div class="clear"></div>
                                <div class="hoodie"></div>
                            </div>

                            <div class="slide slide3">
                                <h3>STEP THREE:</h3>
                                <p>Are you ready?</p>
                                <div class="hoodie"></div>
                                <h4>SIZE: <span>LARGE</span></h4>
                                <button class="sendOrder" href="#submit"></button>
                            </div>

                            <div class="clear"></div>
                        </div>
                    </div>
                        
                    <a class="arrow arrowLeft arrowLeftOff" href="#"></a>
                    <a class="arrow arrowRight arrowRightOn" href="#"></a>
                    
                </article>
            </section>
            
            <?php include_once '../includes/footer.php'; ?>
            
        </div>
        <?php include_once '../includes/scripts.php'; ?>
        <script type="text/javascript">
            Cufon.replace('h1, #logoDefault, #amp, #logoFirstName');
        </script>
    </body>
</html>