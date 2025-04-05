function fixDate(type, value, hash) {
  if (type !== "commit" && type !== "tag") return;
  // Add up to 3 extra newlines and try all 30-minutes timezone offsets.
  var clone = JSON.parse(JSON.stringify(value));
  for (var x = 0; x < 3; x++) {
    for (var i = -720; i < 720; i += 30) {
      if (type === "commit") {
        clone.author.date.offset = i;
        clone.committer.date.offset = i;
      }
      else if (type === "tag") {
        clone.tagger.date.offset = i;
      }
      if (hash !== hashAs(type, clone)) continue;
      // Apply the changes and return.
      value.message = clone.message;
      if (type === "commit") {
        value.author.date.offset = clone.author.date.offset;
        value.committer.date.offset = clone.committer.date.offset;
      }
      else if (type === "tag") {
        value.tagger.date.offset = clone.tagger.date.offset;
      }
      return true;
    }
    clone.message += "\n";
  }
  return false;
}