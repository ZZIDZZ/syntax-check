function detectTakeout(selectors){
    var properties = {
      takeout: false
    };

    options.takeout.forEach(function (takeout) {
      selectors.forEach(function (selector) {
        if (selector.indexOf(takeout.ruleprefix) === 0) {
          properties.takeout = true;
          properties.filename = takeout.filename;
        }
      });
    });

    return properties;
  }