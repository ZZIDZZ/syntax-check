public Muxer getMuxer() {
    long cPtr = VideoJNI.MuxerStream_getMuxer(swigCPtr, this);
    return (cPtr == 0) ? null : new Muxer(cPtr, false);
  }