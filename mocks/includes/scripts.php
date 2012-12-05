<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <!--<script type="text/javascript" src="../js/retina.js"></script>-->
        <script src="../js/cufon.js"></script>
        <script src="../js/goodby.font.js"></script>
        <script src="../js/class.js"></script>
        <script src="../js/base.js"></script>
        <script src="../js/scroller.js"></script>
        <script src="../js/app.js"></script>
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
            var str = 'url(http://localhost.com/images/stuff/image.png)';
            
            var regex = new RegExp("http://[a-zA-Z0-9\.\/]+", "g");
            
            var result = regex.exec(str);
            
            console.dir(result);
        </script>