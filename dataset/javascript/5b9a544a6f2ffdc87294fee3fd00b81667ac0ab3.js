function(analyzed) {
    var containers = analyzed.topology.containers;
    var targets = [];

    _.each(containers, function(c) {
      if (c.containerDefinitionId.indexOf('__proxy') === 0) {
        var cdef = _.find(analyzed.containerDefinitions, function(cdef) { return cdef.id === c.containerDefinitionId; });
        targets.push({containerDef: cdef, container: c});
      }
    });
    return targets;
  }