<!--                <form action="<?php echo Router::url(array('controller' => 'users', 'action' => 'login')); ?>" autocomplete="on">
                    <fieldset id="email">
                        <input type="email" name="email" placeholder="your_email@gspsf.com" autocomplete="on" value="" required>
                    </fieldset>
                    <fieldset id="submit">
                        <input type="submit">
                    </fieldset>
                </form>-->
<?php

    echo $this->Form->create(null, array(
        'url' => array('controller' => 'users', 'action' =>  'login'),
        'type' => 'post',
        'label' => ''
    ));
    echo $this->Form->input(null, array(
        'type' => 'email',
        'label' => '',
        'value' => $email
    ));
    echo $this->Form->end('Submit');
    
?>