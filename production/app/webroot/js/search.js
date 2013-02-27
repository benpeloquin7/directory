var Search = Base.extend({
    _form:{},
    _input:{},
    _submit: {},
    _searchBox: {},
    
    init: function() {
        this._super();
        
        this._form = $('#PersonSearchForm');
        
        this._input = $('#phrase');
        
        this._searchBox = $('#searchBox');
        
        this._submit = this._form.find(':submit');
        
        var self = this;
        
        this._input.on('click', function(evt) {
            self._input.val('');
        });
        
        this._submit.on('click', function(evt) {
            evt.preventDefault();
            self.handleFormSubmit(evt);
        });
        
        this._searchBox.on('click', function(evt) {
            evt.preventDefault();
            self.handleSearchBoxClick(evt);
        })
    },
    
    handleFormSubmit: function(evt) {
        // gather form data
        var data = this._form.serialize();
        
        // submit to proper url
        $.post(this._form[0].action, data, function(data) {
            console.dir(data);
            // wait for a response and take action
        }, 'json');
       
    },
            
    handleSearchBoxClick: function(evt) {
        // expand the hidden div
        var hs = $('#hiddenSearch');
        
        hs.css({
            'width': '100%',
            'height' : '100%',
            'opacity': 0.7
        });
        
        var hsc = $('#searchClose');
        
        hsc.on('click', function(evt) {
            evt.preventDefault();
            hs.css({
                'width': '0',
                'height' : '0',
                'opacity': 0
            });
        })
    }
});