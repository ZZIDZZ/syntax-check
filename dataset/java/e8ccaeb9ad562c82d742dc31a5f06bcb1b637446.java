public void shutdown(final String reason)
    {
        OtpOutputStream shutdown = new OtpOutputStream();
        shutdown.write(OtpExternal.versionTag);
        final OtpErlangObject[] tuple = {new OtpErlangAtom("shutdown"),
                                         new OtpErlangString(reason)};
        shutdown.write_any(new OtpErlangTuple(tuple));
        send(shutdown);
    }