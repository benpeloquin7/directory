<?php
//    $this->Html->script('carousel', array('block' => 'scriptBottom'));

    // define custom styles for the <head>
//    $this->Html->css(array('hoodie'), 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 1)', 'block' => 'hoodieStyle'));
//    $this->Html->css(array('hoodie-retina'), 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 2)', 'block' => 'hoodieStyleRetina'));

//    $this->Html->css('/css/hoodie.css.php', 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 1)', 'block' => 'hoodieStyle'));
//    $this->Html->tag('link', null, array('href' => '/css/hoodies.css.php', 'rel' => 'stylesheet', 'type' => 'text/css', 'media' => 'only screen and (-webkit-min-device-pixel-ratio: 1)', 'block' => 'hoodieStyle'));

    $this->start('hoodieStyle');
    echo '<link rel="stylesheet" type="text/css" href="'.$this->webroot . '/css/hoodies.css.php" />';
    $this->end();
    $this->Html->css('/css/hoodie-retina.css', 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 2)', 'block' => 'hoodieStyleRetina'));

    $this->Html->script('scroller', array('block' => 'scrollerJS'));
?> 

            <section id="ajax">
                    
                <article>
                    
                    <div id="slideWindow">
                        <div id="slideContainer">
                            
                            <div class="slide slide1">
                                <h1 class="anim1">WELCOME <span><?php echo $firstName; ?></span></h1>
                                <p class="anim2 cufon">Should our next holiday party be at slims or sfmoma?</p>

                                <div id="patch" class="<?php echo $letter; ?> anim3"></div>

                                <h2 class="anim4"><span id="logoDefault">GOODBY SILVERSTEIN</span><br /><span id="amp">&</span> <span id="logoFirstName"><?php echo $lastName; ?></span></h2>
                            </div>

                            <div class="slide slide2">
                                <h2 class="cuf">STEP TWO:</h2>
                                <p class="cuf">Please select a size...</p>
                                <ul class="sizes">
                                    <li id="small"><a class="size small" href="#S">Small</a></li>
                                    <li id="medium"><a class="size medium" href="#M">Medium</a></li>
                                    <li id="large"><a class="size large" href="#L">Large</a></li>
                                    <li id="extraLarge"><a class="size extraLarge" href="#XL">Extra Large</a></li>
                                </ul>
                                <div class="clear"></div>
                                <div class="hoodie"></div>
                            </div>

                            <div class="slide slide3">
                                <h3 class="cuf">STEP THREE:</h3>
                                <p class="cuf">Are you ready?</p>
                                <div class="hoodie"></div>
                                <h4 class="cuf">SIZE: <span>LARGE</span></h4>
                                <button class="sendOrder" href="#submit"></button>
                            </div>

                            <div class="clear"></div>
                        </div>
                    </div>
                    
                    <div id="hoodieFormContainer">
                        <?php

                            echo $this->Form->create(null, array(
                                'url' => array('controller' => 'hoodies', 'action' =>  'addHoody'),
                                'type' => 'post',
                            ));
                            
//                            echo $this->Form->input('letter', array(
//                                'type' => 'text',
//                                'id' => 'letter',
//                                'class' => 'hoodieInput',
//                                'label' => 'Letter',
//                                'value' => ''
//                            ));
                            
                            echo $this->Form->input('size', array(
                                'type' => 'hidden',
                                'label' => 'Size',
                                'class' => 'hoodieInput',
                                'id' => 'size',
                                'value' => ''
                            ));
                            
                            echo $this->Form->input('user_id', array(
                                'type' => 'hidden',
                                'label' => '',
                                'value' => $userId
                            ));
                            
                            echo $this->Form->input('letter', array(
                                'type' => 'hidden',
                                'label' => '',
                                'value' => $letter
                            ));
                            
                        ?>
                    </div>
                        
                    <a class="arrow arrowLeft arrowLeftOff" href="#"></a>
                    <a class="arrow arrowRight arrowRightOn" href="#"></a>
                    
                </article>
            </section>