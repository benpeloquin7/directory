<?php
    $this->start('pollStyle');
    echo '<link rel="stylesheet" type="text/css" href="'.$this->webroot . '/css/poll.css.php" />';
    $this->end();
    $this->Html->css('/css/poll-retina.css', 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 2)', 'block' => 'pollStyleRetina'));
    
    $this->Html->script('vote', array('block' => 'voteJS'));
?>
            <section id="ajax">
                    
                <article>
                    
                    <!--<img class="lightbulb" src="<?php echo $this->webroot; ?>/img/vote/lightbulb-light@2x.png" alt="lightbulb" />-->
                    
                    <div class="lightbulb"></div>
                    <h1><?php echo $poll['Poll']['title']; ?></h1>
                    <p><?php echo $poll['Poll']['poll_text']; ?></p>
                    
                    <?php
                        $left = ($poll['Poll']['tally_1'] / ($poll['Poll']['tally_1'] + $poll['Poll']['tally_2'])) * 100;
                        $right = ($poll['Poll']['tally_2'] / ($poll['Poll']['tally_1'] + $poll['Poll']['tally_2'])) * 100;
                    ?>
                    
                    <div class="leftValue">
                        <span class="answer"><?php echo $poll['Poll']['answer_1']; ?></span>
                        <br />
                        <span class="tally"><?php echo $left . '%'; ?></span>
                    </div>
                    
                    <div class="rightValue">
                        <span class="answer"><?php echo $poll['Poll']['answer_2']; ?></span>
                        <br />
                        <span class="tally"><?php echo $right . '%'; ?></span>
                    </div>
                    
                    <div id="buttonsContainer" class="rest">
                        <a class="leftButton button" data-conclass="leftActive" href="#0"></a>
                        <a class="rightButton button" data-conclass="rightActive" href="#1"></a>
                        <a class="submitButton button" data-conclass="submitActive" href="#submit"></a>
                    </div>
                    
                    <div id="pollFormContainer">
                        <?php

                            echo $this->Form->create(null, array(
                                'url' => array('controller' => 'votes', 'action' =>  'addVote'),
                                'type' => 'post',
                            ));
                            
                            echo $this->Form->input('answer', array(
                                'type' => 'hidden',
                                'class' => 'answerInput',
                                'id' => 'answer',
                                'value' => ''
                            ));
                            
                            echo $this->Form->input('user_id', array(
                                'type' => 'hidden',
                                'label' => '',
                                'value' => $poll['User']['id']
                            ));
                            
                            echo $this->Form->input('poll_id', array(
                                'type' => 'hidden',
                                'label' => '',
                                'value' => $poll['Poll']['id']
                            ));
                            
                        ?>
                    </div>
                    
                </article>
                
                <?php Debugger::dump($poll); ?>
            </section>

 