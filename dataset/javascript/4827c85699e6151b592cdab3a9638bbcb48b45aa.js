function varDeclOrAssignment(parsed, declarator, kind) {
  var topLevel = topLevelDeclsAndRefs(parsed),
      name = declarator.id.name
  return topLevel.declaredNames.indexOf(name) > -1 ?
    // only create a new declaration if necessary
    exprStmt(assign(declarator.id, declarator.init)) :
    {
     declarations: [declarator],
     kind: kind || "var", type: "VariableDeclaration"
    }
}