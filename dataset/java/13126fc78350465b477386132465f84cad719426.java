public static int poolid(int agentid) {
    int poolid = agentid / poolsize;
    if (poolid + 1 > npools) {
      poolid = npools - 1;
    }
    return poolid;
  }