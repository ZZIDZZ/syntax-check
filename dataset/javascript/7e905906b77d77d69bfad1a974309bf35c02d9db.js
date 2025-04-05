function Random(seed) {
    this.multiplier = 16807;
    this.modulus = 0x7fffffff;
    this.seed = seed;
    this.mq = Math.floor(this.modulus / this.multiplier);
    this.mr = this.modulus % this.multiplier;
}