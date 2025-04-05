function(e, t) {
        var str = (typeof t === 'string') ? t : this.toCss(t);
        setElementTransformProperty(e, str);
      }