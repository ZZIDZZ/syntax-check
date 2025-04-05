function extract(str, options) {
  const res = babylon.parse(str, options);
  return res.comments;
}