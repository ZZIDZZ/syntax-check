function processFile (filePath, update) {
  let change, found = false;
  const lines = fs.readFileSync(filePath, { encoding: 'utf8' }).split('\n');

  for (let i = 0; i < lines.length; i++) {
    if (lines[i].indexOf(this.targetText) !== -1) {
      found = true;
      change = lines[i].replace(
        this.targetText, this.replacementText
      );
      if (update) {
        lines[i] = change;
      } else {
        // log the line that would be edited.
        this.logger('*** File:   ' + filePath);
        this.logger('@@@ Found:  ' + lines[i]);
        this.logger('--- Change: ' + change);
      }
      this.matchedFileCount++;
      break;
    }
  }

  if (!found && !update) {
    // log the file that would be omitted
    this.logger('*** Omitted: ' + filePath);
  }

  if (found && update) {
    fs.writeFileSync(filePath, lines.join('\n'), { encoding: 'utf8' });
    // log the updated file
    this.logger('@@@ Updated: ' + filePath);
  }

  this.totalFileCount++;
}