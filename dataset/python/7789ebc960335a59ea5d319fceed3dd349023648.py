def send(self):
        """
        Send the message.
        First, a message is constructed, then a session with the email
        servers is created, finally the message is sent and the session
        is stopped.
        """
        self._generate_email()

        if self.verbose:
            print(
                "Debugging info"
                "\n--------------"
                "\n{} Message created.".format(timestamp())
            )

        recipients = []
        for i in (self.to, self.cc, self.bcc):
            if i:
                if isinstance(i, MutableSequence):
                    recipients += i
                else:
                    recipients.append(i)

        session = self._get_session()
        if self.verbose:
            print(timestamp(), "Login successful.")

        session.sendmail(self.from_, recipients, self.message.as_string())
        session.quit()

        if self.verbose:
            print(timestamp(), "Logged out.")

        if self.verbose:
            print(
                timestamp(),
                type(self).__name__ + " info:",
                self.__str__(indentation="\n * "),
            )

        print("Message sent.")