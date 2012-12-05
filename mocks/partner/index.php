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
                            
                            <div class="slide slide2">

                            </div>
                            
                            <div class="slide slide1">
                                <h1>WELCOME <span></span></h1>
                                <p>Should our next holiday party be at slims or sfmoma?</p>

                                <div id="patch"></div>

                                <h2><span id="logoDefault">GOODBY SILVERSTEIN</span> <span id="amp">&</span> <span id="logoFirstName">leah</span></h2>
                            </div>

                            

                            <div class="slide slide3">

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