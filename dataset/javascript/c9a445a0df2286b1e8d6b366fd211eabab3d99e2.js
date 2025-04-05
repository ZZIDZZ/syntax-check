async function waitAttributeToBe (selector, key, value, timeout) {
  return await this.waitUntil(async () => {
    const got = await this.element(selector).getAttribute(key)
    return [].concat(value).some((value) => got === value || String(got) === String(value))
  }, timeout, `Timeout to wait attribute "${key}" on \`${selector}\` to be \`${JSON.stringify(value)}\``)
}