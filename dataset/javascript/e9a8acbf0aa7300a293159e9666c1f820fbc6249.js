function createPagesUtility (pages, index) {
  return function getPages (number) {
    var offset = Math.floor(number / 2)
    var start, end

    if (index + offset >= pages.length) {
      start = Math.max(0, pages.length - number)
      end = pages.length
    } else {
      start = Math.max(0, index - offset)
      end = Math.min(start + number, pages.length)
    }

    return pages.slice(start, end)
  }
}