public Attachment forceDeleteAttachment(Attachment attachmentParam)
    {
        if(attachmentParam != null && this.serviceTicket != null)
        {
            attachmentParam.setServiceTicket(this.serviceTicket);
        }

        return new Attachment(this.postJson(
                attachmentParam,
                WS.Path.Attachment.Version1.attachmentDelete(true)));
    }