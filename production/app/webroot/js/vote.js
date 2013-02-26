var Vote = Base.extend({
    _form:{},
    _submit: {},
    
    /**
     *  Initialization function for votes (one per vote form)
     *  
     *  @param {string} id the css identifier of the form to track
     */
    init: function(id) {
        this._super();
        
        this._form = $('#' + id);
        
        this._submit = this._form.find(':submit');
        
        var self = this;
        
        this._submit.on('click', function(evt) {
            evt.preventDefault();
            self.handleFormSubmit(evt);
        });
    },
    
    handleFormSubmit: function(evt) {
        // gather form data
        var data = this._form.serialize();
        console.log(data)
        
        // submit to proper url
        $.post(this._form[0].action, data, function(data) {
            console.dir(data);
            // wait for a response and take action
        }, 'json');
       
    }
});