private void writeName(String uri, String localName, String qName,
                           boolean isElement) throws SAXException {
        String prefix = doPrefix(uri, qName, isElement);
        if (prefix != null && !"".equals(prefix)) {
            write(prefix);
            write(':');
        }
        if (localName != null && !"".equals(localName)) {
            write(localName);
        } else {
            int i = qName.indexOf(':');
            write(qName.substring(i + 1, qName.length()));
        }
    }