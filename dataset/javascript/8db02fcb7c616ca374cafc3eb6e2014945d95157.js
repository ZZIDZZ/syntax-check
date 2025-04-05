function () {
            var r;

            // Recall as new if new isn't provided :)
            if( Util.isnt.instanceof( NewClass, this ) ) {
                return ClassUtil.construct( NewClass, arguments );
            }

            // call the constructor
            if ( Util.is.Function( this.initialize ) ) {
                r = this.initialize.apply(this, arguments);
            }

            // call all constructor hooks
            this.callInitHooks();

            return typeof r != 'undefined' ? r : this;
        }