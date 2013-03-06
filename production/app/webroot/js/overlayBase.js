var OverlayBase = Base.extend({
    
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
        
        this._oc.on('expand', function(evt) {
            self.handleOverlayExpand(evt);
        });
        
        this._oc.on('contract', function(evt) {
            self.handleOverlayContract(evt);
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
    },
            
    handleOverlayExpand: function(evt) {
        var oc = this._oc;
        
        oc.css({
            'height': '575px'
        });
    },
            
    handleOverlayContract: function(evt) {
        var oc = this._oc;
        
        oc.css({
            'height': '472px'
        });
    }
            
    
});