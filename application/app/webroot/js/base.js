/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var Base = Class.extend({
    
    /**
     * The window pixel ratio
     * @access  public
     */
    pixelRatio: 0,
    
    /**
     * Display ratio in string format
     * @access  public
     */
    pixelRatioName: 'normal',
    
    init: function() {
        
        this.pixelRatio = window.devicePixelRatio;
        
        if(this.pixelRatio >= 2) {
            this.pixelRatioName = 'retina';
        }
            
    }
});