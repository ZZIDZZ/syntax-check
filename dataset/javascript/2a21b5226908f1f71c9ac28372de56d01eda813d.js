function getStartStopBoundaries(parent, sidebar, topOffset) {
  const bbox = parent.getBoundingClientRect();
  const sidebarBbox = sidebar.getBoundingClientRect();
  const bodyBbox = document.body.getBoundingClientRect();

  const containerAbsoluteTop = bbox.top - bodyBbox.top;
  const sidebarAbsoluteTop = sidebarBbox.top - bodyBbox.top;
  const marginTop = sidebarAbsoluteTop - containerAbsoluteTop;
  const start = containerAbsoluteTop - topOffset;
  const stop = bbox.height + containerAbsoluteTop - sidebarBbox.height - marginTop - topOffset;

  return {
    start,
    stop,
  };
}