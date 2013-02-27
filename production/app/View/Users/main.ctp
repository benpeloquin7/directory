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
        'label' => 'Search',
        'value' => 'Search...'
    ));
    
    echo $this->Form->end('Submit');
    
?>

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

<?php
    foreach($voting_modules as $voting_module) {
        echo $this->Form->create('Vote', array(
            'id' => 'Vote_Poll_' . $voting_module['id'],
            'url' => array('controller' => 'votes', 'action' =>  'submit'),
            'type' => 'post',
            'label' => ''
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

<pre>
<?php
print_r($session);
?>
</pre>

