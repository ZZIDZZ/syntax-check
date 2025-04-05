function(value) {
            if(value != value || value === 0) {
                for(var i = this.length; i-- && !is(this[i], value);){}
            } else {
                i = [].indexOf.call(this, value);
            }
            return i;
        }