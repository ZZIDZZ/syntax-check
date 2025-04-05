function filterRelations(relation) {
    var mappedData = includedData.find(function (inc) {
      return inc.id === relation.id;
    });
    var RelationModel = getModel(relation.type);
    var modeledData = new RelationModel(mappedData);

    return checkForRelations(modeledData, modeledData.data);
  }