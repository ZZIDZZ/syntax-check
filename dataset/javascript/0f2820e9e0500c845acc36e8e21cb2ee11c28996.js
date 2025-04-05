function mainControlBox() {
  d3.select('#show-struct')
    .on('change', function () {
      const data = nodeContentInput();
      d3.select('#main-control').datum(data);
      updateNodeStructure(data);
    })
    .dispatch('change');
}