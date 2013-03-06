var Message = Base.extend({
    
    messageContainer: {},
    
    contentContainer: {},
    
    init: function() {
        this.messageContainer = $('.message');
        this.contentContainer = $('.message .content');
        
        var self = this;
        
        this.messageContainer.on('showMessage', function(evt, message) {
            self.showMessage(message);
        });
        
        this.messageContainer.on('webkitTransitionEnd oTransitionEnd transitionend', function(evt) {
            
            var mc = self.messageContainer;
            
            var o = mc.css('opacity');
            
            if(o == 0) {
                self.hideMessage();
            }
            
        });
        
    },
            
    showMessage: function(m) {

        var ms = this.messageContainer;
        
        var c = this.contentContainer;
        
        c.text(m);

        ms.css({
            display: 'block'
        });
        
        var self = this;
        
        setTimeout(function() {
            
            self.messageContainer.css({
                opacity: 1
            });
            
        }, 100);
        
        setTimeout(function() {
            self.fadeMessageOut();
        }, 3000);
    },
            
    fadeMessageOut: function() {

        var ms = this.messageContainer;
        
        ms.css({
            opacity: 0
        });
        
    },
            
    hideMessage: function() {
        
        var ms = this.messageContainer;
        
        ms.css({
            display: 'none'
        });
        
    }
      
});
