<div class="gridster">
    <ul>
        <li data-row="1" data-col="1" data-sizex="2" data-sizey="2">
            <div class="search box">
                
            </div>
        </li>

        <li data-row="1" data-col="3" data-sizex="1" data-sizey="1">
            <div class="profile box">
                
            </div>
        </li>
        <li data-row="2" data-col="3" data-sizex="1" data-sizey="1">
            
            <div class="shop box">
                
            </div>
        </li>
        <li data-row="1" data-col="4" data-sizex="1" data-sizey="1">
            <div class="comment box">
                
            </div>
        </li> 
        <li data-row="2" data-col="4" data-sizex="1" data-sizey="1">
            <div class="poll box">
                
            </div>
        </li>

        <li class="black" data-row="3" data-col="1" data-sizex="4" data-sizey="3">
            <div class="welcome box">
                <h1>Welcome <?php echo $session['User']['firstName']; ?></h1>
                <?php echo $this->Html->image('letters/' . strtolower(substr($session['User']['lastName'], 0, 1)) . '@2x.png', array('alt' => 'Goodby Silverstein & ' . $session['User']['lastName'])); ?>
                <h2><?php echo 'Goodby Silverstein <span class="logoRed">&</span> ' . $session['User']['lastName']; ?></h2>
            </div>
        </li>

        <li data-row="6" data-col="1" data-sizex="3" data-sizey="1">
            <div class="quote box">
                
            </div>
        </li> 
        <li data-row="6" data-col="4" data-sizex="1" data-sizey="1">
            <div class="idea box">
                
            </div>
        </li>
    </ul>
</div>

<div class="overlayContainer">
    <div class="overlayWrap">
        <div class="overlay searchOverlay">
            <span class="close">Close&nbsp;&nbsp;<strong>X</strong></span>
            
            <!--<h3>GS<span class="logoRed">&AMP;</span>P Directory Search</h3>-->
            <?php

                echo $this->Form->create('Person', array(
                    'url' => array('controller' => 'people', 'action' =>  'search'),
                    'type' => 'post',
                    'label' => '',
                    'id' => 'PersonSearchForm'
                ));

                echo $this->Form->input('phrase', array(
                    'id' => 'phrase',
                    'type' => 'text',
                    'label' => '',
                    'value' => 'Search...'
                ));

                echo $this->Form->end('Submit');

            ?>
        </div>
        
        <div class="overlay profileOverlay">
            <span class="close">Close&nbsp;&nbsp;<strong>X</strong></span>
            
            <h3>GS<span class="logoRed">&AMP;</span>P Directory Search</h3>
            
        </div>
        
        <div class="overlay commentOverlay">
            <span class="close">Close&nbsp;&nbsp;<strong>X</strong></span>
            
            <h3>Have a suggestion or idea? Tell us.</h3>
            
            <?php

                echo $this->Form->create('Idea', array(
                    'url' => array('controller' => 'ideas', 'action' =>  'submit'),
                    'type' => 'post',
                    'label' => ''
                ));

                echo $this->Form->input('idea', array(
                    'id' => 'idea',
                    'type' => 'text',
                    'label' => '',
                    'value' => ''
                ));

                echo $this->Form->end('Submit');

            ?>
            
        </div>
        
        <div class="overlay shopOverlay">
            <span class="close">Close&nbsp;&nbsp;<strong>X</strong></span>
            
            <h3>Hoody Order Form.</h3>
            
            <?php

                echo $this->Form->create('Hoody', array(
                    'url' => array('controller' => 'hoodies', 'action' =>  'submit'),
                    'type' => 'post',
                    'label' => ''
                ));

                echo $this->Form->input('size', array(
                    'id' => 'size',
                    'type' => 'text',
                    'label' => 'Hoodie Size',
                    'value' => $hoody_size
                ));

                echo $this->Form->input('letter', array(
                    'id' => 'letter',
                    'type' => 'text',
                    'label' => 'Hoodie Letter',
                    'value' => $hoody_letter
                ));

                echo $this->Form->end('Submit');

            ?>
            
        </div>
        
        <div class="overlay pollOverlay">
            <span class="close">Close&nbsp;&nbsp;<strong>X</strong></span>
            
            <h3>Polls.</h3>
            
            <?php
                foreach($voting_modules as $voting_module) {

                    echo $this->Form->create('Vote', array(
                        'id' => 'Vote_Poll_' . $voting_module['id'],
                        'url' => array('controller' => 'votes', 'action' =>  'submit'),
                        'type' => 'post',
                        'label' => '',
                        'data-poll-id' => $voting_module['id'],
                        'data-tally-a' => $voting_module['tally']['tally_a'],
                        'data-tally-b' => $voting_module['tally']['tally_b']
                    ));

                    echo $this->Form->input('poll_id', array(
                        'id' => 'poll_id_' . $voting_module['id'],
                        'type' => 'hidden',
                        'label' => 'Poll ID',
                        'value' => $voting_module['id']
                    ));

                    echo $this->Form->input('answer', array(
                        'id' => 'answer_' . $voting_module['id'],
                        'type' => 'text',
                        'label' => 'Poll Answer',
                        'value' => $voting_module['previous_answer']
                    ));

                    echo $this->Form->end('Submit');
                }
            ?>
            
        </div>
        
        
    </div>
</div>

<div class="clear"></div>

<div id="hiddenSearch">
    <div id="searchIcon"></div>
    <div id="searchFormContainer">
        
        <div id="searchClose"></div>
    </div>
    
</div>




<div id="hidden">
   


</div>