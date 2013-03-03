var OverlayBase = Class.extend({
    
    _oc: {},
    
    init: function() {
        this._oc = $('.overlayContainer');
        
        var self = this;
        
        this._oc.on('bringToFront', function(evt) {
            self.handleBringToFront(evt);
        });
        
        this._oc.on('sendToBack', function(evt) {
            self.handleSendToBack(evt);
        });
    },
            
    handleBringToFront: function(evt) {
        var oc = this._oc;
        
        oc.css({
            'opacity': '1',
            'z-index': '3'
        });
    },
            
    handleSendToBack: function(evt) {
        var oc = this._oc;
        
        oc.css({
            'opacity': '0',
            'z-index': '1'
        });
    }
            
    
});