def email(cls, invoice, kind):
        ''' Sends out an e-mail notifying the user about something to do
        with that invoice. '''

        context = {
            "invoice": invoice,
        }

        send_email([invoice.user.email], kind, context=context)