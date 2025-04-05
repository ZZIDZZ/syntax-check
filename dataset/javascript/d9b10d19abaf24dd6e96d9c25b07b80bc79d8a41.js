function(event) {
    event.preventDefault();
    this.setState({
      mode: 'all',
      selected: null,
    }, function() {
      this.refs.scroller.animateAndResetScroll(0, this.state.previousScrollPosition);
    });
  }