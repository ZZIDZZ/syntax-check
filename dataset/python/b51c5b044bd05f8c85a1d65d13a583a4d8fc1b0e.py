def write(self, output_buffer, kmip_version=enums.KMIPVersion.KMIP_1_0):
        """
        Write the data encoding the GetAttributes response payload to a
        stream.

        Args:
            output_buffer (stream): A data stream in which to encode object
                data, supporting a write method; usually a BytearrayStream
                object.
            kmip_version (KMIPVersion): An enumeration defining the KMIP
                version with which the object will be encoded. Optional,
                defaults to KMIP 1.0.
        """
        local_buffer = utils.BytearrayStream()

        if self._unique_identifier:
            self._unique_identifier.write(
                local_buffer,
                kmip_version=kmip_version
            )
        else:
            raise exceptions.InvalidField(
                "The GetAttributes response payload is missing the unique "
                "identifier field."
            )

        if kmip_version < enums.KMIPVersion.KMIP_2_0:
            for attribute in self._attributes:
                attribute.write(local_buffer, kmip_version=kmip_version)
        else:
            if self._attributes:
                # TODO (ph) Add a new utility to avoid using TemplateAttributes
                template_attribute = objects.TemplateAttribute(
                    attributes=self.attributes
                )
                attributes = objects.convert_template_attribute_to_attributes(
                    template_attribute
                )
                attributes.write(local_buffer, kmip_version=kmip_version)
            else:
                raise exceptions.InvalidField(
                    "The GetAttributes response payload is missing the "
                    "attributes list."
                )

        self.length = local_buffer.length()
        super(GetAttributesResponsePayload, self).write(
            output_buffer,
            kmip_version=kmip_version
        )
        output_buffer.write(local_buffer.buffer)