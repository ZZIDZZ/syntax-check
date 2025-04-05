function(){
    this.date = new Date();

    this.getHours = function() {
        return this.date.getHours();
    };

    this.getMinutes = function() {
        return this.date.getMinutes();
    };

    this.hoursIsBetween = function(a, b) {
			if(a <= b) return this.date.getHours() >= a && this.date.getHours() <=b;
			else return this.date.getHours() >= a || this.date.getHours() <= b;
    };

    this.step = function(){
        this.date = new Date();
        this.isMorning = this.hoursIsBetween(6, 11);
        this.isNoon = this.hoursIsBetween(12, 14);
        this.isAfternoon = this.hoursIsBetween(15, 17);
        this.isEvening = this.hoursIsBetween(18, 23);
        this.isNight = this.hoursIsBetween(0,5);
        return this;
    };
}