function() {
            if (!this.currentView) return false;

            $(SpecialK.container).hide();
            this.currentView.unbind();
            this.currentView.remove();
            this.currentView = null;
            return true;
        }