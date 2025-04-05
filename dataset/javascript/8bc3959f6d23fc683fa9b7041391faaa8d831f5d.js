async function indexExists(index) {
  try {
    const { nbHits } = await index.search();
    return nbHits > 0;
  } catch (e) {
    return false;
  }
}