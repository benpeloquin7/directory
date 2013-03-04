var Vote = Base.extend({
    _form:{},
    _submit: {},
    _archtype: {},
    _A: {},
    _B: {},
    _tally: {},
    
    /**
     *  Initialization function for votes (one per vote form)
     *  
     *  @param {string} id the css identifier of the form to track
     */
    init: function(id) {
        this._super();
        
        this._form = $('#' + id);
        
        this._submit = this._form.find(':submit');
        
        // TODO set the true data here from data-attr of the form
        var pollId = this._form.data('poll-id');
        var tallyA = this._form.data('tally-a');
        var tallyB = this._form.data('tally-b');
        this._tally = {
            poll_id: pollId,
            tally_a: tallyA,
            tally_b: tallyB
        };
        
        this.createArchtype(id);
        this.createAB();
        this.animateAB();
        
        var self = this;
        
        this._submit.on('click', function(evt) {
            evt.preventDefault();
            self.handleFormSubmit(evt);
        });
        
        this._form.on('animateVotes', function(evt) {
            
            self.resetAB();
            
            var s = self;
            
            setTimeout(function() {
                s.createAB();
                s.animateAB();
            }, 700);
            
            // TODO write something here that changes the percentage readouts when we vote
        });
        
        
    },
    
    handleFormSubmit: function(evt) {
        // gather form data
        var data = this._form.serialize();
        console.log(data);
        
        var self = this;
        
        $.post(this._form[0].action, data, function(data) {
            console.dir(data);
            
            
            
            if(data.response == true) {
                // set the new tally data before we trigger an update
                var pollId = self._tally.poll_id;
                self._tally = data.tally[pollId];
                
                self._form.trigger('animateVotes');
            }
            
        }, 'json');
       
    },
            
    createArchtype: function(id) {
        var archtype = Raphael(id, 500, 300);
        
        archtype.customAttributes.arc = function (xloc, yloc, value, total, R) {
            var alpha = 360 / total * value,
                a = (90 - alpha) * Math.PI / 180,
                x = xloc + R * Math.cos(a),
                y = yloc - R * Math.sin(a),
                path;
            if (total == value) {
                path = [
                    ["M", xloc, yloc - R],
                    ["A", R, R, 0, 1, 1, xloc - 0.01, yloc - R]
                ];
            } else {
                path = [  
                    ["M", xloc, yloc - R],
                    ["A", R, R, 0, +(alpha > 180), 1, x, y]
                ];
            }
            return {
                path: path
            };  
        };

        archtype.customAttributes.reverseArc = function (xloc, yloc, value, total, R) {
            var alpha = 360 / total * value,
                a = (90 + alpha) * Math.PI / 180,
                x = xloc + R * Math.cos(a),
                y = yloc - R * Math.sin(a),
                path;
            if (total == value) {
                path = [
                    ["M", xloc, yloc - R],
                    ["A", R, R, 0, 1, 1, xloc - 0.01, yloc - R]
                ];
            } else {
                path = [  
                    ["M", xloc, yloc - R],
//                                ["A", R, R, 1, 1, 0, x, y]
                    ["A", R, R, 0, +(alpha > 180), 0, x, y]
                ];
            }
            return {
                path: path
            };
        };
        
        this._archtype = archtype;
    },
            
    createAB: function() {

        var archtype = this._archtype;
        
        var stroke = 30;
        
        var tallyA = this._tally.tally_a,
            tallyB = this._tally.tally_b;

        var A = archtype.path().attr({
            "stroke": "#aeaeae",
            "stroke-width": stroke,
            arc: [150, 150, 0, (tallyA + tallyB), 60]
        });
        
        var B = archtype.path().attr({
            "stroke": "#ff2222",
            "stroke-width": stroke,
            reverseArc: [150, 150, 0, (tallyA + tallyB), 60]
        });
        
        this._A = A;
        this._B = B;
    },
    
    animateAB: function() {
        var A = this._A,
            B = this._B;
    
        var tallyA = this._tally.tally_a,
            tallyB = this._tally.tally_b;
    
        A.animate({
            arc: [150, 150, tallyA, (tallyA + tallyB), 60]
        }, 1500, "bounce");
        
        B.animate({
            reverseArc: [150, 150, tallyB, (tallyA + tallyB), 60]
        }, 1500, "bounce");
    },
    
    resetAB: function() {
        var A = this._A,
            B = this._B;
    
        var tallyA = this._tally.tally_a,
            tallyB = this._tally.tally_b;
    
        A.animate({
            arc: [150, 150, 0, (tallyA + tallyB), 60]
        }, 300, "linear");
        
        B.animate({
            reverseArc: [150, 150, 0, (tallyA + tallyB), 60]
        }, 300, "linear");
    }
    
});
