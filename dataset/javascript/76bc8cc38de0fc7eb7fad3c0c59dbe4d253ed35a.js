function fmix32_pure (hash) {
    hash = (hash ^ (hash >>> 16)) >>> 0
    hash = multiply(hash, 0x85ebca6b)
    hash = (hash ^ (hash >>> 13)) >>> 0
    hash = multiply(hash, 0xc2b2ae35)
    hash = (hash ^ (hash >>> 16)) >>> 0
    return hash
}