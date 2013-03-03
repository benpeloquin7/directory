var Overlay = OverlayBase.extend({
    
    _elem: {},
    _ov: {},
    _close: {},
    
    init: function(c) {
        this._super();
        
        this._elem = $('.' +  c);
        this._ov = $('.'+c+'Overlay');
        this._close = $('.'+c+'Overlay .close');
        
        var self = this;
        
        this._elem.on('click', function(evt) {        
            self.handleTileClick(evt);
        });
        
        this._close.on('click', function(evt) {
            self.handleOverlayClose(evt);
        });
        
    },
            
    handleTileClick: function(evt) {

        console.log('open clicked')
    
        var oc = this._oc;
        var overlay = this._ov;
        
        oc.trigger('bringToFront');
        
        overlay.css({
            display: 'block'
        });
        
        setTimeout(function() {
            overlay.css({
                opacity: 1,
            });
            console.log('should have opacity 1')
        }, 300);
        
            
        
        
    },
            
    handleOverlayClose: function(evt) {

        console.log('close clicked')
    
        var oc = this._oc;
        var overlay = this._ov;
        
        oc.trigger('sendToBack');
        
        
        
        setTimeout(function() {
            overlay.css({
                opacity: 0
            });
            
            overlay.css({
                display: 'none'
            });
        }, 300);
    }
    
});