def parser_from_schema(schema_url, require_version=True):
    """
    Returns an XSD-schema-enabled lxml parser from a WSDL or XSD

    `schema_url` can of course be local path via file:// url
    """
    schema_tree = etree.parse(schema_url)

    def get_version(element, getter):
        try:
            return getter(element)
        except VersionNotFound:
            if require_version:
                raise
            else:
                return None

    root = schema_tree.getroot()
    if root.tag == '{%s}definitions' % namespaces.WSDL:
        # wsdl should contain an embedded schema
        schema_el = schema_tree.find('wsdl:types/xs:schema', namespaces=NS_MAP)
        version = get_version(root, version_from_wsdl)
    else:
        schema_el = root
        version = get_version(schema_el, version_from_schema)

    schema = etree.XMLSchema(schema_el)
    return objectify.makeparser(schema=schema), version