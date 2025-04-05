function characterListhasEntities(characterList) {
  var hasEntities = false;
  characterList.forEach(function (characterMeta) {
    if (characterMeta.get('entity') !== null) {
      hasEntities = true;
    }
  });
  return hasEntities;
}