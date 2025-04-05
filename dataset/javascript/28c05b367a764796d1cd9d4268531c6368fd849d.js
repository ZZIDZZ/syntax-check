function transformRangeAnchor(target, op, isStart) {
  var thisCell = parseCell(target)
  if (op instanceof InsertCol) {
    var otherCell = parseCell(op.newCol)
    if (otherCell[0] <= thisCell[0]) return column.fromInt(thisCell[0]+1)+thisCell[1]
  }
  else if (op instanceof DeleteCol) {
    var otherCell = parseCell(op.col)
    if (otherCell[0] < thisCell[0]) return column.fromInt(thisCell[0]-1)+thisCell[1]
    if (otherCell[0] === thisCell[0]) {
      // Spreadsheet selection is different from text selection:
      // While text selection ends in the first *not* selected char ( "foo| |bar" => 3,4)
      // ... spreadsheet selection ends in the last selected cell. Thus we need to
      // differentiate between start and end. Shame on those who didn't think about this!
      if (!isStart) return column.fromInt(thisCell[0]-1)+thisCell[1]     }
  }
  else if (op instanceof InsertRow) {
    var otherCell = parseCell(op.newRow)
    if (otherCell[1] <= thisCell[1]) return column.fromInt(thisCell[0])+(thisCell[1]+1)
  }
  else if (op instanceof DeleteRow) {
    var otherCell = parseCell(op.col)
    if (otherCell[1] < thisCell[1]) return column.fromInt(thisCell[0])+(thisCell[1]-1)
    if (otherCell[1] === thisCell[1]) {
      if (!isStart) return column.fromInt(thisCell[0])+(thisCell[1]-1)
    }
  }
  // If nothing has returned already then this anchor doesn't change
  return target
}