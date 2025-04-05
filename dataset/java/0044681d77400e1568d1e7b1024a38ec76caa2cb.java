private void rule3() {
        if (parent instanceof XsdSchema && attributesMap.containsKey(REF_TAG)){
            throw new ParsingException(XSD_TAG + " element: The " + REF_TAG + " attribute cannot be present when the parent of the " + xsdElementIsXsdSchema);
        }
    }