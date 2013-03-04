<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <?php if($isMobile) : ?>
        <!-- 57 x 57 Android and iPhone 3 icon -->
        <link rel="apple-touch-icon" media="screen and (resolution: 163dpi)" href="icon57x57.png" />
        <!-- 114 x 114 iPhone 4 icon -->
        <link rel="apple-touch-icon" media="screen and (resolution: 326dpi)" href="icon57.png" />
        <!-- 57 x 57 Nokia icon -->
        <link rel="shortcut icon" href="icon57x57.png" />
        <!-- Viewport scaling -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Don't allow text size adjust on device orientation change -->
        <style type="text/css">
            body {
                -webkit-text-size-adjust: none;
            }
        </style>
        <?php endif; ?>
        <?php
        
        echo $this->Html->css('reset');
        echo $this->Html->css('style');
        echo $this->Html->css('animation');
        ?>
    </head>
    <body>
        
        <!-- Here's where I want my views to be displayed -->
        <div id="wrap">
            <?php echo $this->fetch('content'); ?>    
        </div>

        <!-- Add a footer to each displayed page -->
        <!--<div id="footer">...</div>-->
        <?php
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
        ?>
        <script>
            (function($) {
                $(window).load(function() {
                    var _form = $('#PersonChallengeForm');
                    var _submit = $('input:submit');
                    var _email = $('#email');
                    
//                    console.dir(_form);
                    
                    _submit.on('click', function(evt) {
                        evt.preventDefault();
                        
//                        console.log('submit button clicked');
                        
                        // validate the email form
                        if(_email.val().length > 0) {
                            if(IsEmail(_email.val())) {
                                // submit the form via ajax to the action location
                                
//                                console.dir(_submit);
                                
                                $.post(_form[0].action, {'data[Person][email]':_email.val()}, function(data) {
                                    console.dir(data);
                                    
                                    if(data.response) {
                                        window.location = data.redirect;
                                    }
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
    </body>
</html>