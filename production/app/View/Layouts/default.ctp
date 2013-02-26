<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <!-- Include external files and scripts here (See HTML helper for more info.) -->
        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>

        <!-- If you'd like some sort of menu to
        show up on all of your views, include it here -->
        <div id="header">
            <div id="menu">Header</div>
        </div>

        <!-- Here's where I want my views to be displayed -->
        <?php echo $this->fetch('content'); ?>

        <!-- Add a footer to each displayed page -->
        <div id="footer">...</div>
        <?php
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
        echo $this->Html->script('class');
        echo $this->Html->script('base');
        echo $this->Html->script('hoody');
        echo $this->Html->script('votes');
        ?>
        <script type="text/javascript">
            (function($) {
                $(window).load(function() {
                    console.log('working')
                    var hoody = new Hoody();
                });
            })(jQuery);
        </script>
    </body>
</html>