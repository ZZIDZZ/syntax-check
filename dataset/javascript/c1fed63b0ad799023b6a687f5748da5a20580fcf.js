function createColorArrow(defElement, color) {
    defElement.append("marker")
        .attr("id", "arrow-" + color)
        .attr("viewBox", "0 -5 10 10")
        .attr("refX", 8)
        .attr("markerWidth", 6)
        .attr("markerHeight", 6)
        .attr("fill", color)
        .attr("orient", "auto")
        .append("path")
        .attr("d", "M0,-5L10,0L0,5")
        .attr("class", "arrowHead");
}