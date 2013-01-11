<?php
    $this->start('pollStyle');
    echo '<link rel="stylesheet" type="text/css" href="'.$this->webroot . '/css/poll.css.php" />';
    $this->end();
    $this->Html->css('/css/poll-retina.css', 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 2)', 'block' => 'pollStyleRetina'));
?>
            <section id="ajax">
                    
                <article>
                    
                    <h1>Test</h1>
                    <p>This is some test content.</p>
                    
<!--                    <div id="slideWindow">
                        <div id="slideContainer">
                            
                            <div class="slide slide1">
                                <h1>WELCOME <span><?php echo $firstName; ?></span></h1>
                                <p>Should our next holiday party be at slims or sfmoma?</p>

                                <div id="patch"></div>

                                <h2><span id="logoDefault">GOODBY SILVERSTEIN</span> <span id="amp">&</span> <span id="logoFirstName"><?php echo $firstName; ?></span></h2>
                            </div>

                            <div class="slide slide2">
                                <h2>STEP TWO:</h2>
                                <p>Please select a size...</p>
                                <ul class="sizes">
                                    <li><a class="size small" href="#S">Small</a></li>
                                    <li><a class="size medium" href="#M">Medium</a></li>
                                    <li><a class="size large" href="#L">Large</a></li>
                                    <li><a class="size extraLarge" href="#XL">Extra Large</a></li>
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
                    
                    <div id="hoodieFormContainer">
                       
                    </div>
                        
                    <a class="arrow arrowLeft arrowLeftOff" href="#"></a>
                    <a class="arrow arrowRight arrowRightOn" href="#"></a>-->
                    
                </article>
            </section>