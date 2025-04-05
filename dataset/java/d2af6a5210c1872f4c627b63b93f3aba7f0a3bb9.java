synchronized Bitmap getNextFrame() {
    if (header.frameCount <= 0 || framePointer < 0) {
      if (Log.isLoggable(TAG, Log.DEBUG)) {
        Log.d(TAG, "unable to decode frame, frameCount=" + header.frameCount + " framePointer="
            + framePointer);
      }
      status = STATUS_FORMAT_ERROR;
    }
    if (status == STATUS_FORMAT_ERROR || status == STATUS_OPEN_ERROR) {
      if (Log.isLoggable(TAG, Log.DEBUG)) {
        Log.d(TAG, "Unable to decode frame, status=" + status);
      }
      return null;
    }
    status = STATUS_OK;

    GifFrame currentFrame = header.frames.get(framePointer);
    GifFrame previousFrame = null;
    int previousIndex = framePointer - 1;
    if (previousIndex >= 0) {
      previousFrame = header.frames.get(previousIndex);
    }

    // Set the appropriate color table.
    act = currentFrame.lct != null ? currentFrame.lct : header.gct;
    if (act == null) {
      if (Log.isLoggable(TAG, Log.DEBUG)) {
        Log.d(TAG, "No Valid Color Table for frame #" + framePointer);
      }
      // No color table defined.
      status = STATUS_FORMAT_ERROR;
      return null;
    }

    // Reset the transparent pixel in the color table
    if (currentFrame.transparency) {
      // Prepare local copy of color table ("pct = act"), see #1068
      System.arraycopy(act, 0, pct, 0, act.length);
      // Forget about act reference from shared header object, use copied version
      act = pct;
      // Set transparent color if specified.
      act[currentFrame.transIndex] = 0;
    }

    // Transfer pixel data to image.
    return setPixels(currentFrame, previousFrame);
  }