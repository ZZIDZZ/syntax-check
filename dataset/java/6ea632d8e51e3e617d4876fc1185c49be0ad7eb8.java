public void setLabel(String v) {
    if (SemanticRole_Type.featOkTst && ((SemanticRole_Type)jcasType).casFeat_label == null)
      jcasType.jcas.throwFeatMissing("label", "edu.cmu.lti.oaqa.type.nlp.SemanticRole");
    jcasType.ll_cas.ll_setStringValue(addr, ((SemanticRole_Type)jcasType).casFeatCode_label, v);}