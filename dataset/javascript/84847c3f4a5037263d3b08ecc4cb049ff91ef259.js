function fix (file, options, emit) {
  const { appdir, bundleid, forceFamily, allowHttp } = options;
  if (!file || !appdir) {
    throw new Error('Invalid parameters for fixPlist');
  }
  let changed = false;
  const data = plist.readFileSync(file);
  delete data[''];
  if (allowHttp) {
    emit('message', 'Adding NSAllowArbitraryLoads');
    if (!Object.isObject(data['NSAppTransportSecurity'])) {
      data['NSAppTransportSecurity'] = {};
    }
    data['NSAppTransportSecurity']['NSAllowsArbitraryLoads'] = true;
    changed = true;
  }
  if (forceFamily) {
    if (performForceFamily(data, emit)) {
      changed = true;
    }
  }
  if (bundleid) {
    setBundleId(data, bundleid);
    changed = true;
  }
  if (changed) {
    plist.writeFileSync(file, data);
  }
}