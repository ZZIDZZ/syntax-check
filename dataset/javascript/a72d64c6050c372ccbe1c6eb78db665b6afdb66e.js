function Point(masterApikey, feedID, streamID) {
  /** @private */this.masterApiKey  = masterApikey;
  /** @private */this.feedID   = feedID.toString();
  /** @private */this.streamID = streamID.toString();
}