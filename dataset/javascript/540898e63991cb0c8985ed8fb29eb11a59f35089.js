function matchOffset(list, offset) {
      return list.some(function(el) { return el.offset === offset ? list = [el] : false; }) ? list : [];
    }