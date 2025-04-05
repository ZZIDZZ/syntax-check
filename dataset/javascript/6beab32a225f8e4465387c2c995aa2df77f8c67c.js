function SM2KeyPair(pub, pri) {
  if (!(this instanceof SM2KeyPair)) {
    return new SM2KeyPair(pub, pri);
  }
  this.curve = SM2; // curve parameter
  this.pub = null; // public key, should be a point on the curve
  this.pri = null; // private key, should be a integer

  var validPub = false;
  var validPri = false;

  if (pub != null) {
    if (typeof pub === 'string') {
      this._pubFromString(pub);
    } else if (Array.isArray(pub)) {
      this._pubFromBytes(pub);
    } else if ('x' in pub && pub.x instanceof BN &&
               'y' in pub && pub.y instanceof BN) {
      // pub is already the Point object
      this.pub = pub;
      validPub = true;
    } else {
      throw 'invalid public key';
    }
  }
  if (pri != null) {
    if (typeof pri === 'string') {
      this.pri = new BN(pri, 16);
    } else if (pri instanceof BN) {
      this.pri = pri;
      validPri = true;
    } else {
      throw 'invalid private key';
    }

    // calculate public key
    if (this.pub == null) {
      this.pub = SM2.g.mul(this.pri);
    }
  }

  if (!(validPub && validPri) && !this.validate()) {
    throw 'invalid key';
  }
}