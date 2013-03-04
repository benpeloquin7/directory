<?php echo $this->Html->image('letters/p@2x.png', array('alt' => 'Goodby Silverstein & Partners', 'class' => 'loginLogo')); ?>
<?php

    echo $this->Form->create(null, array(
        'url' => array('controller' => 'people', 'action' =>  'verify'),
        'type' => 'post',
        'label' => ''
    ));
    
    echo $this->Form->input('email', array(
        'id' => 'email',
        'type' => 'email',
        'label' => '',
        'value' => $preset_user_information['email']
    ));
    
    echo $this->Form->submit('Submit', array(
        'class' => 'redButton'
    ));
    
    echo $this->Form->end();
    
?>