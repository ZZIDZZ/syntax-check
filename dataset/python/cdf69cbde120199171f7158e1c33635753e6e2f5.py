def get(self):
        """
        Return the referer aka the WHOIS server of the current domain extension.
        """

        if not PyFunceble.CONFIGURATION["local"]:
            # We are not running a test in a local network.

            if self.domain_extension not in self.ignored_extension:
                # The extension of the domain we are testing is not into
                # the list of ignored extensions.

                # We set the referer to None as we do not have any.
                referer = None

                if self.domain_extension in PyFunceble.INTERN["iana_db"]:
                    # The domain extension is in the iana database.

                    if not PyFunceble.CONFIGURATION["no_whois"]:
                        # We are authorized to use WHOIS for the test result.

                        # We get the referer from the database.
                        referer = PyFunceble.INTERN["iana_db"][self.domain_extension]

                        if not referer:
                            # The referer is not filled.

                            # We log the case of the current extension.
                            Logs().referer_not_found(self.domain_extension)

                            # And we handle and return None status.
                            return None

                        # The referer is into the database.

                        # We return the extracted referer.
                        return referer

                    # We are not authorized to use WHOIS for the test result.

                    # We return None.
                    return None

                # The domain extension is not in the iana database.

                # We return False, it is an invalid domain.
                return False

            # The extension of the domain we are testing is not into
            # the list of ignored extensions.

            # We return None, the domain does not have a whois server.
            return None

        # We are running a test in a local network.

        # We return None.
        return None