function(facetName) {
    if (!this.isHierarchicalFacet(facetName)) {
      throw new Error(
        'Cannot get the breadcrumb of an unknown hierarchical facet: `' + facetName + '`');
    }

    var refinement = this.getHierarchicalRefinement(facetName)[0];
    if (!refinement) return [];

    var separator = this._getHierarchicalFacetSeparator(
      this.getHierarchicalFacetByName(facetName)
    );
    var path = refinement.split(separator);
    return map(path, trim);
  }