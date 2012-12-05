/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var Scroller = Base.extend({
    
    /**
     * The container for the slider
     * @access  public
     */
    container: {},
    
    /**
     * Slides count
     * @access  public
     */
    slideCount: 0,
    
    /**
     * Indicates how much the container needs to move to position the next
     * slide in the correct place. (slide width + margin-right)
     * @access  public
     */
    slideWidth: 0,
    
    /**
     * Arrow background image dimensions and path
     * slide in the correct place. (slide width + margin-right)
     * @access  public
     */
    arrowMeta: {},
    
    /**
     * Initialization function
     * @access  public
     * @param   object A container element (dom or string) containing slides
     */
    init: function(container) {
        
        this._super();
        
        // set some events
        this.container = $(container);
        
        // count all the slides
        this.slideCount = $('.slide').length;
        
        // set slide width plus margin
        var slideMargin = parseInt($('.slide').css('margin-right').replace('px', ''));
        this.slideWidth = ($('.slide').width() + slideMargin);
                
        // set some events
        var self = this;
        
        $(window).on('raOn raOff laOn laOff', function(evt) {
            
            console.log('event emitted ')
            console.dir(evt)
            
            switch(evt.type) {
                case 'raOn':
                    self.makeRightSelectable();
                    break;
                case 'raOff':
                    self.makeRightUnselectable();
                    break;
                case 'laOn':
                    self.makeLeftSelectable();
                    break;
                case 'laOff':
                    self.makeLeftUnselectable();
                    break;
            }
            
        });
        
        $('.arrow').on('click', function(evt) {
            
            evt.preventDefault();
            
            if($(evt.currentTarget).hasClass('arrowLeft')) {
                self.moveRight();
            }
            
            if($(evt.currentTarget).hasClass('arrowRight')) {
                self.moveLeft();
            }
        });
        
    },
    
    /**
     * Move the slide container left
     * @access  public
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    moveLeft: function() {
        
        // get the current margin
        var ml = this.getMarginLeft();
        
        this.container.css({
            'margin-left': (ml - this.slideWidth) + 'px'
        });
        
        ml = this.getMarginLeft();
        
        var lastSlide = ((this.slideWidth * (this.slideCount -1)) * -1);
        
        if((ml) == lastSlide) {
            $(window).trigger('raOff');
        }
        
        if((ml) > lastSlide) {
            $(window).trigger('raOn');
        }
        
    },
    
    /**
     * Move the slide container to the right
     * @access  public
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    moveRight: function() {
        
        // get the current margin
        var ml = this.getMarginLeft();
        
        this.container.css({
            'margin-left': (ml + this.slideWidth) + 'px'
        });
        
        ml = this.getMarginLeft();
        
//        var lastSlide = (this.slideWidth * (this.slideCount - 1));
        var lastSlide = 0;
        
        if((ml) == lastSlide) {
            $(window).trigger('laOff');
        }
        
        if((ml) < lastSlide) {
            $(window).trigger('laOn');
        }
    },
    
    getMarginLeft: function() {
        return parseInt(this.container.css('margin-left').replace('px', ''));
    },
    
    /**
     * Make the right arrow selectable
     * @access  public
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    makeRightSelectable: function() {
        
        console.log('make right on')
        
        var arrowRight = $('.arrowRight');
        var imageName = $('.arrow').css('background-image');

        var regex = new RegExp("http://[a-zA-Z0-9\.\/]+", "g");
        var imagePath = regex.exec(imageName);
        
        var img = new Image();
        var w, h;
        img.addEventListener('load', function(evt) {
            
            w = evt.currentTarget.width;
            h = evt.currentTarget.height;
            
        }, false);
        img.src = imagePath[0];
        
        var left = -1* (w/2);
        var top = -1 * (h/2);
        
        arrowRight.css({
            'background': imageName + ' ' + left + 'px ' + top + 'px scroll no-repeat'
        });
        
    },
    
    /**
     * Make the right arrow selectable
     * @access  public
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    makeRightUnselectable: function() {
        
        console.log('turn right off')
        
        var arrowRight = $('.arrowRight');
        var imageName = $('.arrow').css('background-image');

        var regex = new RegExp("http://[a-zA-Z0-9\.\/]+", "g");
        var imagePath = regex.exec(imageName);
        
        var img = new Image();
        var w, h;
        img.addEventListener('load', function(evt) {
            
            w = parseInt(evt.currentTarget.width.replace('px', ''));
            h = parseInt(evt.currentTarget.height.replace('px', ''));
            
        }, false);
        img.src = imagePath[0];
        
        var left = -1* (w/2);
        var top = 0;
        
        console.log('w: ' + w + ' background : ' + imageName + ' ' + left + 'px ' + top + 'px scroll no-repeat')
        
        arrowRight.css({
            'background': imageName + ' ' + left + 'px ' + top + 'px scroll no-repeat'
        });
    },
    
    /**
     * Make the right arrow selectable
     * @access  public
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    makeLeftSelectable: function() {
        
        console.log('turn left on')
        
        var arrowRight = $('.arrowRight');
        var imageName = $('.arrow').css('background-image');

        var regex = new RegExp("http://[a-zA-Z0-9\.\/]+", "g");
        var imagePath = regex.exec(imageName);
        
        var img = new Image();
        var w, h;
        img.addEventListener('load', function(evt) {
            
            w = evt.currentTarget.width;
            h = evt.currentTarget.height;
            
        }, false);
        img.src = imagePath[0];
        
        var left = 0;
        var top = -1 * (h/2);
        
        arrowRight.css({
            'background': imageName + ' ' + left + 'px ' + top + 'px scroll no-repeat'
        });
    },
    
    /**
     * Make the right arrow selectable
     * @access  public
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    makeLeftUnselectable: function() {
        
        console.log('turn left off')
        
        var arrowRight = $('.arrowRight');
        var imageName = $('.arrow').css('background-image');

        var regex = new RegExp("http://[a-zA-Z0-9\.\/]+", "g");
        var imagePath = regex.exec(imageName);
        
        var img = new Image();
        var w, h;
        img.addEventListener('load', function(evt) {
            
            w = evt.currentTarget.width;
            h = evt.currentTarget.height;
            
        }, false);
        img.src = imagePath[0];
        
        var left = 0;
        var top = 0;
        
        arrowRight.css({
            'background': imageName + ' ' + left + 'px ' + top + 'px scroll no-repeat'
        });
    },
    
    /**
     * Get background image path from the background property CSS
     * @access  public
     * @return  string The full path of the background image
     */
    getArrowMeta: function() {
        
        var imageName = $('.arrow').css('background-image');

        var regex = new RegExp("http://[a-zA-Z0-9\.\/]+", "g");
        var imagePath = regex.exec(imageName);
        
        var img = new Image();
        var w, h;
        
        var self = this;
        
        img.addEventListener('load', function(evt) {
            
            this
            w = parseInt(evt.currentTarget.width.replace('px', ''));
            h = parseInt(evt.currentTarget.height.replace('px', ''));
            
        }, false);
        img.src = imagePath[0];
        
        return 'be patient, the answers are coming neo';
        
    }
    
    
    
    
});