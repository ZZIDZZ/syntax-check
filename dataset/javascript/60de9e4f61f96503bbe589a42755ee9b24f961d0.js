function parseShardFun (str /* : string */) /* : ShardV1 */ {
  str = str.trim()

  if (str.length === 0) {
    throw new Error('empty shard string')
  }

  if (!str.startsWith(PREFIX)) {
    throw new Error(`invalid or no path prefix: ${str}`)
  }

  const parts = str.slice(PREFIX.length).split('/')
  const version = parts[0]

  if (version !== 'v1') {
    throw new Error(`expect 'v1' version, got '${version}'`)
  }

  const name = parts[1]

  if (!parts[2]) {
    throw new Error('missing param')
  }

  const param = parseInt(parts[2], 10)

  switch (name) {
    case 'prefix':
      return new Prefix(param)
    case 'suffix':
      return new Suffix(param)
    case 'next-to-last':
      return new NextToLast(param)
    default:
      throw new Error(`unkown sharding function: ${name}`)
  }
}