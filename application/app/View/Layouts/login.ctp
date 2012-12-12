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
        <?php //include_once '../includes/scripts.php'; ?>
    </body>
</html>