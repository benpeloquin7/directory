<!-- 
    Author: Mike Newell © 2012
-->
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=0.5, minimum-scale=0.5 maximum-scale=1.0'" />
        <?php echo $this->Html->charset(); ?>
        
        <title><?php echo $title; ?></title>
        
        <?php echo $this->Html->css('reset'); ?>
        <?php echo $this->Html->css(array('login'), 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 1)')); ?>
        <?php echo $this->Html->css(array('login-retina'), 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 2)')); ?>
<!--        <link rel="stylesheet" type="text/css" href="../css/home/style.css.php" media="only screen and (-webkit-min-device-pixel-ratio: 1)" />-->
<!--        <link rel="stylesheet" type="text/css" href="../css/home/retina.css" media="only screen and (-webkit-min-device-pixel-ratio: 2)" />-->
    </head>
    <body>
        <div id="wrap">
            <section>
                <?php echo $this->fetch('content'); ?>
            </section>
        </div>
        <?php echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'); ?>
        <?php echo $this->Html->script(array('cufon', 'goodby.font', 'quo', 'class', 'base', 'app')); ?>
        <script type="text/javascript">
            (function($) {
                $(window).load(function() {
                    
                    var base = new Base();
                    var app = new App();
                    
                });
            })(jQuery);
        </script>
        <script type="text/javascript">
            Cufon.replace('h1');
        </script>
    </body>
</html>