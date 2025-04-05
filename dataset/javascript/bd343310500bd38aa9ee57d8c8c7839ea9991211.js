function findEmoji(names, match) {
  const compare = match.toLowerCase();
  for (let i = 0; i < names.length; i += 1) {
    const name = names[i].toLowerCase();
    if (name === compare) {
      return names[i];
    }
  }

  return null;
}