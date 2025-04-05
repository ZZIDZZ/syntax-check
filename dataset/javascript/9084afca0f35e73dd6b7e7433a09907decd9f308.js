function parseFlatJSON(jsonFilePath, attributeFields) {
  return new Promise((resolve, reject) => {
    try {
      json(jsonFilePath, data => resolve(_transformToHierarchy(data, attributeFields)));
    } catch (err) {
      reject(err);
    }
  });
}