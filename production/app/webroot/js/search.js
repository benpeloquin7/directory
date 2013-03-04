var Search = Base.extend({
    _form:{},
    _input:{},
    _submit: {},
    _searchBox: {},
    _resultsContainer: {},
    
    init: function() {
        this._super();
        
        this._form = $('#PersonSearchForm');
        
        this._input = $('#phrase');
        
        this._searchBox = $('#searchBox');
        
        this._submit = this._form.find(':submit');
        
        this._resultsContainer = $('.searchResultsContainer');
        
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
        });
        
    },
    
    handleFormSubmit: function(evt) {
        // gather form data
        var data = this._form.serialize();
        var input = this._input;
        var resultsContainer = this._resultsContainer;
        var self = this;
        
        // submit to proper url
        $.post(this._form[0].action, data, function(data) {
//            console.dir(data);
            // wait for a response and take action
            
            self.formatSearchResults(data);
            
        }, 'json');
        
        // move the search bar to the top
        input.css({
            'margin-top': 0
        });
        
        // trigger an expansion
        $('.overlayContainer').trigger('expand');
        
        resultsContainer.css({
            'display': 'block'
        });
       
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
        });
    },
            
    formatSearchResults: function(data) {
        var resultsContainer = this._resultsContainer;
        console.dir(data);
        
        var source = '';
        var script = 'this.src=\'http://m.gspsf.com/images/default.jpg\'';
        
        if(data.response) {
            var dataLength = data.data.length;
            for(var i = 0; i < dataLength; i++) {
                source +=  '<div class="result">';
                source +=      '<img class="profileImg" src="http://goodbysilverstein.com/people/thumbnails/'+data.data[i]['people']['userName']+'.jpg" alt="Profile Image" onerror="'+script+'" />';
                source +=      '<h5>'+data.data[i]['people']['firstName'] + ' ' + data.data[i]['people']['lastName'] +'</h5>';
                source +=      '<p>'+data.data[i]['people']['title']+'</p>';
                source +=      '<div class="clear"></div>';
                source +=      '<a class="contactButton contactEmail" href="mailto:'+data.data[i]['people']['email']+'"><img class="contactEmailImg" src="../img/css/contact-email.png" alt="Email" /></a>';
                source +=      '<a class="contactButton contactTele" href="tel:'+data.data[i]['people']['ext']+'"><img class="contactTeleImg" src="../img/css/contact-tele.png" alt="Telephone" /></a>';
                source +=      '<div class="clear"></div>';
                source +=  '</div>';
                
            }
            
        } else {
            source = '<p>'+data.message+'</p>';
        }
        
        resultsContainer.html(source);
        
    }
});