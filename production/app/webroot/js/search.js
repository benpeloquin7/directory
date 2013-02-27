var Search = Base.extend({
    _form:{},
    _input:{},
    _submit: {},
    
    init: function() {
        this._super();
        
        this._form = $('#PersonSearchForm');
        
        this._input = $('#phrase');
        
        this._submit = this._form.find(':submit');
        
        var self = this;
        
        this._input.on('click', function(evt) {
            self._input.val('');
        });
        
        this._submit.on('click', function(evt) {
            evt.preventDefault();
            self.handleFormSubmit(evt);
        });
    },
    
    handleFormSubmit: function(evt) {
        // gather form data
        var data = this._form.serialize();
        
        // submit to proper url
        $.post(this._form[0].action, data, function(data) {
            console.dir(data);
            // wait for a response and take action
        }, 'json');
       
    }
});