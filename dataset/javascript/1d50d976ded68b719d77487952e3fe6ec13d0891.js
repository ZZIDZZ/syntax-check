function getDefaultPortByProtocol (rawProtocol) {
  // port-numbers expect no trailing colon
  const protocol = rawProtocol.endsWith(':')
    ? rawProtocol.slice(0, -1)
    : rawProtocol

  // e.g. mailto has no port associated
  // example return value:
  // { port: 80, protocol: 'tcp', description: 'World Wide Web HTTP' }
  const portByProtocol = portNumbers.getPort(protocol)

  return portByProtocol
    ? Promise.resolve(String(portByProtocol.port))
    : Promise.reject(new Error('Has no port'))
}