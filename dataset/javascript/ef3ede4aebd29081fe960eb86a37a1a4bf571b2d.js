function _delete(sModuleId) {
  const oModules = getModules();
  if (!isTypeOf(oModules[sModuleId], sNotDefined)) {
    delete oModules[sModuleId];
    return true;
  }
  return false;
}