<pre>
<?php
    print_r($preset_user_information);
?>
</pre>
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
    
    echo $this->Form->end('Submit');
    
?>