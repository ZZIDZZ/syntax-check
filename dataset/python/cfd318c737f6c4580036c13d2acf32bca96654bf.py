def y64_encode(s):
        """
        Implementation of Y64 non-standard URL-safe base64 variant.

        See http://en.wikipedia.org/wiki/Base64#Variants_summary_table

        :return: base64-encoded result with substituted
        ``{"+", "/", "="} => {".", "_", "-"}``.
        """
        first_pass = base64.urlsafe_b64encode(s)
        return first_pass.translate(bytes.maketrans(b"+/=", b"._-"))