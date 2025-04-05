function (key) {
  this.key = key;
  this.keyType = key.split(" ")[0];
  this.rawkey = key.split(" ")[1];
  try{
    this.keyComment = key.split(" ")[2];
  } catch(err){
    this.keyComment = null;
  }

  this.byteArray = this._stringToBytes(atob(this.rawkey));
  this.slicedArray = [];

  this.wordLength = 4;
  this._load();
}