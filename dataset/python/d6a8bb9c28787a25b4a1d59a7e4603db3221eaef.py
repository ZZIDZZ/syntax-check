def from_unknown_text(text, strict=False):
    """
    Detect crs string format and parse into crs object with appropriate function.

    Arguments:

    - *text*: The crs text representation of unknown type. 
    - *strict* (optional): When True, the parser is strict about names having to match
        exactly with upper and lowercases. Default is not strict (False).

    Returns:

    - CRS object.
    """

    if text.startswith("+"):
        crs = from_proj4(text, strict)

    elif text.startswith(("PROJCS[","GEOGCS[")):
        crs = from_unknown_wkt(text, strict)

    #elif text.startswith("urn:"):
    #    crs = from_ogc_urn(text, strict)

    elif text.startswith("EPSG:"):
        crs = from_epsg_code(text.split(":")[1])

    elif text.startswith("ESRI:"):
        crs = from_esri_code(text.split(":")[1])

    elif text.startswith("SR-ORG:"):
        crs = from_sr_code(text.split(":")[1])

    else: raise FormatError("Could not auto-detect the type of crs format, make sure it is one of the supported formats")
    
    return crs