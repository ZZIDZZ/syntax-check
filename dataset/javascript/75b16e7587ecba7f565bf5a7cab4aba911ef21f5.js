function insertionSort(a, l, h, c) {
  for (let i = l + 1; i <= h; i++) {
    const x = a[i];
    let j = i - 1;

    while (j >= 0 && c(a[j], x) > 0) {
      a[j + 1] = a[j];
      j--;
    }

    a[j + 1] = x;
  }
}