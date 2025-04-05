function find_attr_value(attrForms, attrName) {
  var attrVal;
  var attrPos = -1;
  if(attrForms && Array.isArray(attrForms)) {
    attrKey = attrForms.find(function (form, i) {
      attrPos = i;
      return (i % 2 === 1) && form.value === attrName;
    })
    if(attrKey && attrPos+1 < attrForms.length) {
      attrVal = attrForms[attrPos+1];
    }
  }
  return attrVal;
}