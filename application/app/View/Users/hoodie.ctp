<?php
//    $this->Html->script('carousel', array('block' => 'scriptBottom'));
    
    $this->Html->css(array('hoodie'), 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 1)', 'block' => 'hoodieStyle'));
    $this->Html->css(array('hoodie-retina'), 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 2)', 'block' => 'hoodieStyleRetina'));
?>

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