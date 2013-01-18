/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var App = Base.extend({
    init: function() {
        
        this._super();
        
        var self = this;
        
        $('.size').on('click', function(evt) {
            evt.preventDefault();
            self.handleHoodieSize(evt);
        });
        
        $('.sendOrder').on('click', function(evt) {
            evt.preventDefault();
            
            self.handleHoodieSubmit();
        });
        
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
    },
    
    /**
     * Check a string for a valid email
     * @access  public
     * @param   string email an email address
     * @return  true if valid, false if not
     */
    validateOrder: function(size, id) {
        
        if(size === 'S' || size === 'M' || size === 'L' || size === 'XL') {
            if(id > 0) {
                return true;
            }
        }
        
        return false;
        
    },
    
    /**
     * Handle the size of the hoodie when a new size is clicked
     * @access  public
     * @param   e Javascript click event
     * @return  null
     */
    handleHoodieSize: function(evt) {
        var t = $(evt.currentTarget);
        
        var size = t.attr('href').replace('#', '');
        
        $('.size').removeClass('active');
        
        t.addClass('active');
        
        $('#size').val(size);
        
        $('.slide3 h4 span').text(size);
        
    },
    
    /**
     * Handles the form submission for the hoodie submit button
     * @access  public
     * @param   null
     * @return  null
     */
    handleHoodieSubmit: function() {
        
        var self = this;
        
        var size = $('#size').val();
        var id = parseInt($('#HoodyUserId').val());

        var valid = self.validateOrder(size, id);
        console.log('form submit clicked');

        if(valid) {

            var action = $('#hoodieFormContainer form').attr('action');
            var data = {};

            $('#hoodieFormContainer form input').each(function(idx) {
                var key = $(this).attr('name');
                var value = $(this).val();

                data[key] = value;
            });

            console.log('data coming next')
            console.dir(data)

            $.post(action, data, function(data) {
                console.log('response data comping next')
                console.dir(data);
                if(data.response === true) {
                    // I could delay this and have some sort of messaging here
                    window.location = data.redirect;
                }
            });
        }
    },
    
    handleVoteSubmit: function() {
        var self = this;
        
        var action = $('#VoteTakePollForm').attr('action');
        
        var answer = $('#answer').val();
        
        var data = {};
        
        if(answer) {
            $('#VoteTakePollForm input').each(function(idx) {
                var key = $(this).attr('name');
                var value = $(this).val();

                data[key] = value;
            });
            
//            console.log('data coming next')
//            console.dir(data)

            $.post(action, data, function(data) {
//                alert('server responded')
//                console.log('response data coming next')
//                console.dir(data);
                if(data.response === true) {
                    // I could delay this and have some sort of messaging here
                    window.location = data.redirect;
                } else {
                    alert('unable to submit the vote')
                }
            });
        } else {
            alert('Please vote by selecting a response, then try submitting!')
        }
    }
    
});