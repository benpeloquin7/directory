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
            
            // presentation logic
            $('.size').removeClass('active');
            $(this).addClass('active');
            
            // keep track of size
            var s = $(this).data('size');
            self._size = s;
            
        });
        
        // TODO refactor this so we're not listening for the same even in two different classes
        $('.shop').on('click', function(evt) {
            self.updateSizeSelection();
        });
        
        this.updateSizeSelection();
    },
      
    handleFormSubmit: function(evt) {

        // update the form size field
        this._sizeElem.val(this._size);

        // gather form data
        var data = this._form.serialize();
        
        var self = this;
        
        // submit to proper url
        $.post(this._form[0].action, data, function(data) {
            
            console.dir(data);
            
            // wait for a response and take action
            self.updateSizeSelection();
            
            // show the success or failure message
            $('.message').trigger('showMessage', [data.message]);
            
        }, 'json');
       
    },
            
    updateSizeSelection: function(){

        var sizeForm = this._sizeElem;
        
        var si = sizeForm.val();
        
        this._size = si;
        
        $('.size').removeClass('active');
        
        $('.' + si).addClass('active');

    }
});