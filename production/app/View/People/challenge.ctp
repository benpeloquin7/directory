<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>
<?php
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>
<pre>
<?php
    print_r($preset_user_information);
?>
</pre>
<html>
    <head>
        <title>Challenge</title>
        <style>
            body {
                background-color: white;
            }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>
            (function($) {
                $(window).load(function() {
                    var _form = $('#PersonChallengeForm');
                    var _submit = $('input:submit');
                    var _email = $('#email');
                    
                    console.dir(_form);
                    
                    _submit.on('click', function(evt) {
                        evt.preventDefault();
                        
                        console.log('submit button clicked');
                        
                        // validate the email form
                        if(_email.val().length > 0) {
                            if(IsEmail(_email.val())) {
                                // submit the form via ajax to the action location
                                $.post(_form[0].action, function(data) {
                                    console.dir(data);
                                }, 'json');
                            }
                        }
                                
                        
                        
                    });
                    
                    function IsEmail(email) {
                        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        return regex.test(email);
                    }
                    
                });
            })(jQuery);
        </script>
    </head>
    <body>
        <div id="wrap">
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
        </div>
    </body>
</html>