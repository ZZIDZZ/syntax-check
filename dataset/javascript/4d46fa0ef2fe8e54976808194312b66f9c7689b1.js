function (event) {
      if (event.name === 'goToLevel') {
        if (event.level === self.level) {
          this.transitionTo(open);
        } else {
          self.pushLevel(event.level);
          this.transitionTo(moving);
        }
      }
    }