/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var Vote = Base.extend({
    
    /**
     * The container for all buttons
     * @access  public
     */
    container: {},
    
    /**
     * The left button
     * @access  public
     */
    leftButton: {},
    
    /**
     * The right button
     * @access  public
     */
    rightButton: {},
    
    /**
     * The submit button to instigate the vote
     * @access  public
     */
    submitButton: {},
    
    /**
     * Wrapper for all buttons
     * @access  public
     */
    button: {},
    
    /**
     * The form input of the answer field
     * @access  public
     */
    answerInput: {},
    
    /**
     * Initialization function
     * @access  public
     * @param   object A container element (dom or string) containing slides
     */
    init: function(container) {
        
        this._super();
        
        this.leftButton = $('.leftButton');
        this.rightButton = $('.rightButton');
        this.submitButton = $('.submitButton');
        this.button = $('.button');
        this.answerInput = $('#answer');
        this.container = $('#buttonsContainer');
        
        var self = this;
        
        // events
        this.button.on('click', function(evt) {
            evt.preventDefault();
            
            var _target = $(evt.currentTarget);
            
            var active = _target.data('conclass');
            
            self.container.removeClass().addClass(active);
            
            var href = _target.attr('href').replace('#', '');
            
            if(href === 'submit') {
                // submit via ajax to controller
                alert('form submitted!')
            } else {
                console.log(href)

                self.answerInput.val(href);
            }
            
        });
        
        
        
    },
    
    /**
     * Submit the form to the controller
     * @access  public
     * @return  array arr with full name, first name = arr[1], last name = arr[2]
     *          or -1 if we don't have a valid email format
     */
    submit: function() {
        
        // TODO: write a function that submits the script and allows the user to move on
        
    }
    
});