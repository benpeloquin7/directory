/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var App = Base.extend({
    init: function() {
        
        this._super();
        
        var self = this;
        
        console.log('setting up events')
        
//        $('#UserAuthForm').on('submit', function(evt) {
//            evt.preventDefault();
//            
//            var email = $('.email input').val();
//            var action = $(this).attr('action');
//            var eventName = 'UserAuthReturn';
//            
//            if(!self.validateEmail(email)) {
//                return false;
//            }
//            
//            console.log('postData: ' + email + ' action: ' + action + ' eventName: ' + eventName);
//            
//            $(window).on(eventName, function(evt, data) {
//                
//                console.log(data.response)
//                
//                // echo out the data
//                console.dir(evt);
//                console.dir(data);
//            });
//            
//            self.sendPostRequest(action, email, eventName);
//            
//        });
        
    },
    
    /**
     * Send a post request to the specified url
     * @access  public
     * @param   string a The url of the request
     * @param   string d The post data to send
     * @param   string evtName The name of the event to trigger
     * @return  null triggers an event to respond to
     */
    sendPostRequest: function(a, d, evtName) {
        $.post(a, { email: d}, function(data) {
            // trigger event with data
            console.dir(data);
            $(window).trigger(evtName, data);
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
        
        if(typeof email === undefined) {
            return false;
        }
        
        if(email.length <= 5) {
            return false;
        }
        
        var x = email;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
            return false;
        }
        
        return true;
    }   
});