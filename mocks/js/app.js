/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var App = Class.extend({
    init: function() {
        
        var self = this;
        
        $('#submit input').on('click touchend', function(evt) {
            evt.preventDefault();
            var email = $('#email input').val();
            var result = self.parseEmail(email);
            
            if(result) {
                // TODO: make ajax call for next page

                $('#wrap').animate({
                    opacity: 0
                }, 1000, function() {
                    // complete
                })
            }
                
        });
        
    },
    
    /**
     * Parse the user input to the email form field
     * @access  public
     * @param   string e a gspsf formatted email
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    parseEmail: function() {
        
        if(e.search('_') === -1) {
            return false;
        }
        
        var regex = /([a-zA-Z]+)\_([a-zA-Z]+)/;

        var fullName = regex.exec(email);

        return fullName;
        
    }
});

(function($) {
    $(window).load(function() {
        var app = new App();
    });
})(jQuery);


