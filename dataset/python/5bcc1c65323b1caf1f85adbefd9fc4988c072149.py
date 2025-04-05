def cli_encrypt(context, key):
    """
    Encrypts context.io_manager's stdin and sends that to
    context.io_manager's stdout.

    This can be useful to encrypt to disk before attempting to
    upload, allowing uploads retries and segmented encrypted objects.

    See :py:mod:`swiftly.cli.encrypt` for context usage information.

    See :py:class:`CLIEncrypt` for more information.
    """
    with context.io_manager.with_stdout() as stdout:
        with context.io_manager.with_stdin() as stdin:
            for chunk in aes_encrypt(key, stdin, preamble=AES256CBC):
                stdout.write(chunk)
            stdout.flush()