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
        
        <title><?php echo $title; ?></title>
        
        <meta name="viewport" content="width=device-width, initial-scale=0.5, minimum-scale=0.5 maximum-scale=1.0'" />
        <?php echo $this->Html->charset(); ?>
        
        <!-- reset -->
        <?php echo $this->Html->css('reset'); ?>
        
        <!-- common css with standard box format -->
        <?php echo $this->Html->css(array('common'), 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 1)')); ?>
        <?php echo $this->Html->css(array('common-retina'), 'stylesheet', array('media' => 'only screen and (-webkit-min-device-pixel-ratio: 2)')); ?>
        
        <!-- specific page box layout -->
        <?php echo $this->fetch('hoodieStyle'); ?>
        <?php echo $this->fetch('hoodieStyleRetina'); ?>

    </head>
    <body>
        <div id="wrap">
            
            <header>
                <nav>
                    <?php echo $this->Html->link('HOME', array('controller' => 'users', 'action' => 'auth'), array('id' => 'homeNavLink')); ?>
                    <?php echo $this->Html->link('PARTNERS', array('controller' => 'users', 'action' => 'hoodie'), array('id' => 'partnersNavLink')); ?>
                    <?php echo $this->Html->link('BLOGS', array('controller' => 'users', 'action' => 'blog'), array('id' => 'blogsNavLink')); ?>
<!--                    <a href="#" id="">HOME</a>
                    <a href="#" id="partnersNavLink">PARTNERS</a>
                    <a href="#" id="blogsNavLink">BLOGS</a>-->
                </nav>
                <form action="search.php" autocomplete="on">
                    <fieldset id="inputs">
                        <input type="text" name="search" placeholder="Name or email of the person you're searching for..." autocomplete="on" required />
                    </fieldset>
                    <fieldset id="submit">
                        <input type="submit" />
                    </fieldset>
                </form>
            </header>
            
            <?php echo $this->fetch('content'); ?>
            
            <footer>
                
            </footer>
            
        </div>
        <?php echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'); ?>
        <?php echo $this->Html->script(array('cufon', 'goodby.font', 'quo', 'class', 'base', 'app')); ?>
        <?php echo $this->fetch('scrollerJS'); ?>
        <script type="text/javascript">
            (function($) {
                $(window).load(function() {
                    
                    var base = new Base();
                    var scroller = new Scroller('#slideContainer');
                    var app = new App();
                    
                });
            })(jQuery);
        </script>
        <script type="text/javascript">
            Cufon.replace('h1, #logoDefault, #amp, #logoFirstName');
        </script>
    </body>
</html>