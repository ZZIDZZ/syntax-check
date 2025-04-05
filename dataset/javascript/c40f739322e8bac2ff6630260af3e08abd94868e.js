function filterArray (arr, toKeep) {
  var i = 0
  while (i < arr.length) {
    if (toKeep(arr[i])) {
      i++
    } else {
      arr.splice(i, 1)
    }
  }
}