<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <?php
        echo $this->Html->css('reset');
        echo $this->Html->css('style');
        ?>
    </head>
    <body>

        <!-- If you'd like some sort of menu to
        show up on all of your views, include it here -->
<!--        <div id="header">
            <div id="menu">Header</div>
        </div>-->

        <!-- Here's where I want my views to be displayed -->
        <div id="wrap">
            <?php echo $this->fetch('content'); ?>    
        </div>

        <!-- Add a footer to each displayed page -->
        <!--<div id="footer">...</div>-->
        <?php
        echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
        echo $this->Html->script('class');
        echo $this->Html->script('base');
        echo $this->Html->script('hoody');
        echo $this->Html->script('vote');
        echo $this->Html->script('search');
        ?>
        <script type="text/javascript">
            (function($) {
                $(window).load(function() {
                    console.log('working')
                    var hoody = new Hoody();
                    
                    var votePoll1 = new Vote('Vote_Poll_1');
                    var votePoll2 = new Vote('Vote_Poll_2');
                    var votePoll3 = new Vote('Vote_Poll_3');
                    
                    var search = new Search();
                });
            })(jQuery);
        </script>
    </body>
</html>