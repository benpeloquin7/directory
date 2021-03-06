/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var App = Base.extend({
    init: function() {
        
        this._super();
        
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
                    
                });
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
    parseEmail: function(e) {
        
        if(e.search('_') === -1) {
            return false;
        }
        
        if(!this.validateEmail(e)) {
            return false;
        }
        
        var regex = /([a-zA-Z]+)\_([a-zA-Z]+)/;

        var fullName = regex.exec(e);

        return fullName;
        
    },
    
    /**
     * Check a string for a valid email
     * @access  public
     * @param   string email an email address
     * @return  true if valid, false if not
     */
    validateEmail: function(email) {
        var x = email;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
            return false;
        }
        return true;
    }   
});