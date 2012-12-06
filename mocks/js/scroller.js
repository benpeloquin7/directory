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
     * Position indicates the position of the slide 1 = first slide, 2,3 etc.
     * @access  public
     */
    slidePos: 0,
    
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
            
            var _elem = $(evt.currentTarget);
            
            // catch the arrows that are off and do nothing
            if(_elem.hasClass('arrowRightOff') || _elem.hasClass('arrowLeftOff')) {
                return;
            }
            
            if(_elem.hasClass('arrowLeft')) {
                if(self.slidePos > 0 && self.slidePos <= (self.slideCount - 1)) {
                    self.slidePos--;
                }
                
                self.move();
            }
            
            if(_elem.hasClass('arrowRight')) {
                
                if(self.slidePos >= 0 && self.slidePos < (self.slideCount - 1)) {
                    self.slidePos++;
                }
                
                self.move();
            }
        });
        
        this.container.on('webkitTransitionEnd transitionend oTransitionEnd', function() {
            self.checkMovement();
        });
        
    },
    
    /**
     * Move the slide container to the new position
     * @access  public
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    move: function() {
        
        console.log(this.slidePos)
        
        this.container.css({
            'margin-left': '-' + (this.slidePos * this.slideWidth) + 'px'
        });
    },
    
    /**
     * Check the movement of the slides and determin if we need to turn an arrow
     * on or off
     * @access  public
     */
    checkMovement: function(ml, lastSlide) {
        
        if(this.slidePos == (this.slideCount - 1)) {
            $(window).trigger('laOn');
            $(window).trigger('raOff');
        }
        
        if((this.slidePos != 0) && (this.slidePos != (this.slideCount - 1))) {
            $(window).trigger('raOn');
            $(window).trigger('laOn');
        }
        
        if(this.slidePos == 0) {
            $(window).trigger('raOn');
            $(window).trigger('laOff');
        }
    }
    
});