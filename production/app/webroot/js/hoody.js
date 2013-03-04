var Hoody = Base.extend({
    _form:{},
    _sizeElem: {},
    _size: '',
    _submit: {},
    
    init: function() {
        this._super();
        
        this._form = $('#HoodyMainForm');
        
        this._sizeElem = this._form.find('#size');
        
        this._size = this._sizeElem.val();
        
        this._submit = this._form.find(':submit');
        
        var self = this;
        
        this._submit.on('click', function(evt) {
            evt.preventDefault();
            self.handleFormSubmit(evt);
        });
        
        // if the user makes a special selection
        $('.size').on('click', function(evt) {
            evt.preventDefault();
            
            console.log('sanity')
            
            $('.size').removeClass('active');
            $(this).addClass('active');
            
            // update the form value with the correc size
            var s = $(this).data('size');
            self._sizeElem.val(s);
            
        });
        
        this.updateSizeSelection();
    },
    
    handleFormSubmit: function(evt) {
        // gather form data
        var data = this._form.serialize();
        
        var self = this;
        
        // submit to proper url
        $.post(this._form[0].action, data, function(data) {
            console.dir(data);
            // wait for a response and take action
            self.updateSizeSelection();
        }, 'json');
       
    },
            
    updateSizeSelection: function(){

        var sizeForm = this._sizeElem;
        
        var si = sizeForm.val();
        
        this._size = si;
        
        console.log('size found to be: ' + si + ' removing all classes and adding active')
        
        $('.size').removeClass('active');
        
        $('.' + si).addClass('active');

    }
});