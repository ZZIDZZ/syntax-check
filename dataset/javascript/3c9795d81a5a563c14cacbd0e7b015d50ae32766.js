function createPayload(name, level, data) {
  return {
    date: getDate(),
    level: level,
    name: name,
    data: data
  };
}