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
//    arrowMeta: {},
    
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
        
        // get arrow meta for later
//        this.getArrowMeta();
        
                
        // set some events
        var self = this;
        
        $(window).on('raOn raOff laOn laOff', function(evt) {
            
            console.dir(evt)
            
            var _arrowRight = $('.arrowRight');
            var _arrowLeft = $('.arrowLeft');
            
            switch(evt.type) {
                case 'raOn':
                    _arrowRight.addClass('arrowRightOn');
                    _arrowRight.removeClass('arrowRightOff');
                    break;
                case 'raOff':
                    _arrowRight.removeClass('arrowRightOn');
                    _arrowRight.addClass('arrowRightOff');
                    break;
                case 'laOn':
                    _arrowLeft.addClass('arrowLeftOn');
                    _arrowLeft.removeClass('arrowLeftOff');
                    break;
                case 'laOff':
                    _arrowLeft.addClass('arrowLeftOff');
                    _arrowLeft.removeClass('arrowLeftOn');
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
        
        this.container.on('webkitTransitionEnd transitionend oTransitionEnd', function() {
            self.checkMovement();
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
        
//        var self = this;
//        setTimeout(function() {
//            self.checkMovement();
//        }, 200);
        
        
        
    },
    
    checkMovement: function(ml, lastSlide) {
        
        var ml = this.getMarginLeft();
        var lastSlide = ((this.slideWidth * (this.slideCount -1)) * -1);
        
        if(ml == lastSlide) {
            $(window).trigger('laOn');
            $(window).trigger('raOff');
        }
        
        if((ml != lastSlide) && (ml != 0)) {
            $(window).trigger('raOn');
            $(window).trigger('laOn');
        }
        
        if(ml == 0) {
            $(window).trigger('raOn');
            $(window).trigger('laOff');
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
//    makeRightSelectable: function() {
//        
////        console.log('make right on')
//        
//        var arrowRight = $('.arrowRight');
//        
//        // use arrow meta
//        
////        var left = -1 * (this.arrowMeta.w/2);
////        var top = -1 * (this.arrowMeta.h/2);
////        
////        arrowRight.css({
////            'background': 'url(' + this.arrowMeta.path + ') ' + left + 'px ' + top + 'px scroll no-repeat'
////        });
//        
//        arrowRight.removeClass('arrowRightOn');
//        
//    },
//    
//    /**
//     * Make the right arrow selectable
//     * @access  public
//     * @return  array arr with full name, first name = arr[1], last name = arr[2]
//     *          or -1 if we don't have a valid email format
//     */
//    makeRightUnselectable: function() {
//        
////        console.log('turn right off')
//        
//        var arrowRight = $('.arrowRight');
//        
//        // use arrow meta
//        
////        var left = -1* (this.arrowMeta.w/2);
////        var top = 0;
////        
////        arrowRight.css({
////            'background': 'url(' + this.arrowMeta.path + ') ' + left + 'px ' + top + 'px scroll no-repeat'
////        });
//        
//        arrowRight.addClass('arrowRightOff');
//    },
//    
//    /**
//     * Make the right arrow selectable
//     * @access  public
//     * @return  array arr with full name, first name = arr[1], last name = arr[2]
//     *          or -1 if we don't have a valid email format
//     */
//    makeLeftSelectable: function() {
//        
////        console.log('turn left on')
//        
//        var arrowRight = $('.arrowLeft');
//        
//        // use arrow meta
//        
////        var left = 0;
////        var top = -1 * (this.arrowMeta.h/2);
////        
////        arrowRight.css({
////            'background': 'url(' + this.arrowMeta.path + ') ' + left + 'px ' + top + 'px scroll no-repeat'
////        });
//        
//        arrowRight.removeClass('arrowLeftOn');
//    },
//    
//    /**
//     * Make the right arrow selectable
//     * @access  public
//     * @return  array arr with full name, first name = arr[1], last name = arr[2]
//     *          or -1 if we don't have a valid email format
//     */
//    makeLeftUnselectable: function() {
//        
////        console.log('turn left off')
//        
//        var arrowRight = $('.arrowLeft');
//        
//        // use arrow meta
////        
////        var left = 0;
////        var top = 0;
////        
////        arrowRight.css({
////            'background': 'url(' + this.arrowMeta.path + ') ' + left + 'px ' + top + 'px scroll no-repeat'
////        });
//        
//        arrowRight.addClass('arrowLeftOff');
//    },
    
    /**
     * Get background image path from the background property CSS
     * @access  public
     * @return  string The full path of the background image
     */
//    getArrowMeta: function(className) {
//        
//        if(className === undefined) {
//            var className = '.arrow';
//        }
//        
//        var imageName = $(className).css('background-image');
//        var self = this;
//
//        var regex = new RegExp("http://[a-zA-Z0-9\.\/@]+", "g");
//        var imagePath = regex.exec(imageName);
//        
//        var img = new Image();
//        
//        $(img).on('load', function(evt) {
//            
//            var w = parseInt(this.width);
//            var h = parseInt(this.height);
//            
//            self.arrowMeta = {
//                w: w,
//                h: h,
//                path: imagePath[0],
//                name: imageName
//            };
//            
//        });
//            
//        img.src = imagePath[0];
//        
//        return 'be patient, the answers are coming neo';
//        
//    }
    
});