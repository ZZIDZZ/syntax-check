def change_resource_record_set_writer(connection, change_set, comment=None):
    """
    Forms an XML string that we'll send to Route53 in order to change
    record sets.

    :param Route53Connection connection: The connection instance used to
        query the API.
    :param change_set.ChangeSet change_set: The ChangeSet object to create the
        XML doc from.
    :keyword str comment: An optional comment to go along with the request.
    """

    e_root = etree.Element(
        "ChangeResourceRecordSetsRequest",
        xmlns=connection._xml_namespace
    )

    e_change_batch = etree.SubElement(e_root, "ChangeBatch")

    if comment:
        e_comment = etree.SubElement(e_change_batch, "Comment")
        e_comment.text = comment

    e_changes = etree.SubElement(e_change_batch, "Changes")

    # Deletions need to come first in the change sets.
    for change in change_set.deletions + change_set.creations:
        e_changes.append(write_change(change))

    e_tree = etree.ElementTree(element=e_root)

    #print(prettyprint_xml(e_root))

    fobj = BytesIO()
    # This writes bytes.
    e_tree.write(fobj, xml_declaration=True, encoding='utf-8', method="xml")
    return fobj.getvalue().decode('utf-8')