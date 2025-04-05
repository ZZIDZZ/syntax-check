public ByteBuffer encodePFrame(Picture pic, ByteBuffer _out) {
        frameNumber++;
        return doEncodeFrame(pic, _out, true, frameNumber, SliceType.P);
    }