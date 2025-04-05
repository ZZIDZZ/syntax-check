function gitUrlPath(gitUrl) {
  // Foreign URL for remote helper
  // See transport_get in transport.c
  // Note:  url.parse considers second : as part of path.  So check this first.
  const foreignParts = /^([A-Za-z0-9][A-Za-z0-9+.-]*)::(.*)$/.exec(gitUrl);
  if (foreignParts) {
    return foreignParts[2];
  }

  // Typical URL
  const gitUrlObj = url.parse(gitUrl);
  if (gitUrlObj.protocol) {
    return gitUrlObj.path;
  }

  // SCP-like syntax.  Host can be wrapped in [] to disambiguate path.
  // See parse_connect_url and host_end in connect.c
  const scpParts = /^([^@/]+)@(\[[^]\/]+\]|[^:/]+):(.*)$/.exec(gitUrl);
  if (scpParts) {
    return scpParts[3];
  }

  // Assume URL is a local path
  return gitUrl;
}