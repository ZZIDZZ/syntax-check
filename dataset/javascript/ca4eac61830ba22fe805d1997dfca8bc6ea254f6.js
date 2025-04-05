function _save() {
    if (db.source && db.write && writeOnChange) {
      var str = JSON.stringify(db.object);

      if (str !== db._checksum) {
        db._checksum = str;
        return db.write(db.source, db.object);
      }
    }
  }