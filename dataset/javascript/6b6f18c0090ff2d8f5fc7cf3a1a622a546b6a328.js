function exclude(a, b, v) {
  const aStart = a.start({type: "bigInteger"});
  const bStart = b.start({type: "bigInteger"});
  const aEnd = a.end({type: "bigInteger"});
  const bEnd = b.end({type: "bigInteger"});
  const parts = [];

  // compareTo returns negative if left is less than right

  //       aaa
  //   bbb
  //   aaa
  //       bbb
  if (aStart.compareTo(bEnd) > 0 || aEnd.compareTo(bStart) < 0) {
    return [a.cidr];
  }

  //   aaa
  //   bbb
  if (aStart.compareTo(bStart) === 0 && aEnd.compareTo(bEnd) === 0) {
    return [];
  }

  //   aa
  //  bbbb
  if (aStart.compareTo(bStart) > 0 && aEnd.compareTo(bEnd) < 0) {
    return [];
  }

  // aaaa
  //   bbbb
  // aaaa
  //   bb
  if (aStart.compareTo(bStart) < 0 && aEnd.compareTo(bEnd) <= 0) {
    parts.push({
      start: aStart,
      end: bStart.subtract(one),
    });
  }

  //    aaa
  //   bbb
  //   aaaa
  //   bbb
  if (aStart.compareTo(bStart) >= 0 && aEnd.compareTo(bEnd) > 0) {
    parts.push({
      start: bEnd.add(one),
      end: aEnd,
    });
  }

  //  aaaa
  //   bb
  if (aStart.compareTo(bStart) < 0 && aEnd.compareTo(bEnd) > 0) {
    parts.push({
      start: aStart,
      end: bStart.subtract(one),
    });
    parts.push({
      start: bEnd.add(one),
      end: aEnd,
    });
  }

  const remaining = [];
  for (const part of parts) {
    for (const subpart of subparts(part, v)) {
      remaining.push(formatPart(subpart, v));
    }
  }

  return cidrTools.merge(remaining);
}