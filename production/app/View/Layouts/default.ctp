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
        
        // gridster
        echo $this->Html->css('vendor/qunit');
        echo $this->Html->css('vendor/jquery.gridster.min');
        
        echo $this->Html->css('reset');
        echo $this->Html->css('style');
        ?>
    </head>
    <body>
        <?php 
        
//            var_dump($isMobile);
//            var_dump($isTablet);
        ?>
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
        
        // gridster
        echo $this->Html->script('vendor/jquery.gridster.with-extras.min');
        echo $this->Html->script('vendor/qunit');
        echo $this->Html->script('vendor/jquery.collision');
        echo $this->Html->script('vendor/jquery.coords');
//        echo $this->Html->script('vendor/jquery.draggable');
        echo $this->Html->script('vendor/utils');
        
        echo $this->Html->script('raphael');
        echo $this->Html->script('vendor/cufon');
        echo $this->Html->script('vendor/goodby.font');
        echo $this->Html->script('class');
        echo $this->Html->script('base');
        echo $this->Html->script('hoody');
        echo $this->Html->script('vote');
        echo $this->Html->script('search');
        echo $this->Html->script('idea');
        echo $this->Html->script('overlayBase');
        echo $this->Html->script('overlay');
        ?>
        <script type="text/javascript">
            (function($) {
                $(window).load(function() {
                    
                    // debug
                    var debug = true;
                    
                    // initialize
                    var hoody = new Hoody();
                    
                    var votePoll1 = new Vote('Vote_Poll_1');
                    var votePoll2 = new Vote('Vote_Poll_2');
                    var votePoll3 = new Vote('Vote_Poll_3');
                    
                    var search = new Search();
                    
                    var idea = new Idea();
                    
//                    var ob = new OverlayBase();
                    var searchOverlay = new Overlay('search'); 
                    var profileOverlay = new Overlay('profile');
                    var commentOverlay = new Overlay('comment');
                    var commentOverlay = new Overlay('shop');
                    var pollOverlay = new Overlay('poll');
                    var ideaOverlay = new Overlay('idea');
                    
                    // debug
                    if(debug) {
                        var objects = new Array();
                        objects.push(
                                hoody,
                                votePoll1, 
                                votePoll2, 
                                votePoll3,
                                search,
                                idea,
                                searchOverlay,
                                profileOverlay,
                                commentOverlay,
                                pollOverlay,
                                ideaOverlay
                        );
                            
                        for(var i = 0; i < objects.length; i++) {
                            console.dir(objects[i]);
                        }
                    }
                    
                    $(".gridster ul").gridster({
                        widget_margins: [5, 5],
                        widget_base_dimensions: [65, 86],
                    }).data('gridster').disable();
                    
                    Cufon.replace('h1, h2, h3, input');
                });
            })(jQuery);
        </script>
    </body>
</html>