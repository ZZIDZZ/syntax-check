async function getExistingSim (opts) {
  const devices = await getDevices(opts.platformVersion);
  const appiumTestDeviceName = `appiumTest-${opts.deviceName}`;

  let appiumTestDevice;

  for (const device of _.values(devices)) {
    if (device.name === opts.deviceName) {
      return await getSimulator(device.udid);
    }

    if (device.name === appiumTestDeviceName) {
      appiumTestDevice = device;
    }
  }

  if (appiumTestDevice) {
    log.warn(`Unable to find device '${opts.deviceName}'. Found '${appiumTestDevice.name}' (udid: '${appiumTestDevice.udid}') instead`);
    return await getSimulator(appiumTestDevice.udid);
  }
  return null;
}