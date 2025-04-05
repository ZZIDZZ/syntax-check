function serveGitFile(repo, tree, parts, res, next) {
  //console.log("Serving git file: " + parts);
  var thisPart = parts.shift();
  var isLastPart = parts.length === 0;
  var entryIndex = -1;
  for (var i=0; i < tree.entries.length; i++) {
    if (tree.entries[i].name === thisPart) {
      entryIndex = i;
      break;
    }
  }
  if (entryIndex < 0) return next();
  var entry = tree.entries[entryIndex];
  if (isLastPart) {
    repo.getBlob(entry.id, function(err, buf) {
      if (err) return next(err);
      if (!buf.data) return next();
      serveBuffer(buf.data, res, thisPart);
    });
  } else {
    repo.getTree(entry.id, function(err, entryTree) {
      if (err) return next(err);
      serveGitFile(repo, entryTree, parts, res, next);
    });
  }
}