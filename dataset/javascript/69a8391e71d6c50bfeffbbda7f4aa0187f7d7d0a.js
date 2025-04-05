function (ms, cycles) {
  var removed = {};

  cycles.forEach(function (c) {
    var last = c[c.length-1]; // last id in cycle
    //console.log('will try to trim from', last, ms[last]);

    // need to find a dependency in the cycle
    var depsInCycle = ms[last].filter(function (deps) {
      return deps.path && c.indexOf(deps.path) >= 0;
    });
    if (!depsInCycle.length) {
      throw new Error("logic fail2"); // last thing in a cycle should have deps
    }
    var depToRemove = depsInCycle[0].path;
    //console.log('deps in cycle', depsInCycle);

    for (var i = 0; i < ms[last].length; i += 1) {
      var dep = ms[last][i];
      if (dep.path && dep.path === depToRemove) {
        //console.log('removing', depToRemove);
        removed[last] = dep.name;
        ms[last].splice(i, 1);
      }
    }
    //console.log('after remove', ms[last]);
  });

  return removed;
}