function(bg) {
    bg = bg ? bg : false

    return (...args) => {
      return this.output(args.join(' '), this.colors(bg))
    }
  }