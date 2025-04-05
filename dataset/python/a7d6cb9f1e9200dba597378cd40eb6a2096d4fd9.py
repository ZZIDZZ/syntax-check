def render_ditaa(self, code, options, prefix='ditaa'):
    """Render ditaa code into a PNG output file."""
    hashkey = code.encode('utf-8') + str(options) + \
              str(self.builder.config.ditaa) + \
              str(self.builder.config.ditaa_args)
    infname = '%s-%s.%s' % (prefix, sha(hashkey).hexdigest(), "ditaa")
    outfname = '%s-%s.%s' % (prefix, sha(hashkey).hexdigest(), "png")

    inrelfn = posixpath.join(self.builder.imgpath, infname)
    infullfn = path.join(self.builder.outdir, '_images', infname)
    outrelfn = posixpath.join(self.builder.imgpath, outfname)
    outfullfn = path.join(self.builder.outdir, '_images', outfname)

    if path.isfile(outfullfn):
        return outrelfn, outfullfn

    ensuredir(path.dirname(outfullfn))

    # ditaa expects UTF-8 by default
    if isinstance(code, unicode):
        code = code.encode('utf-8')

    ditaa_args = [self.builder.config.ditaa]
    ditaa_args.extend(self.builder.config.ditaa_args)
    ditaa_args.extend(options)
    ditaa_args.extend( [infullfn] )
    ditaa_args.extend( [outfullfn] )

    f = open(infullfn, 'w')
    f.write(code)
    f.close()

    try:
        self.builder.warn(ditaa_args)
        p = Popen(ditaa_args, stdout=PIPE, stdin=PIPE, stderr=PIPE)
    except OSError, err:
        if err.errno != ENOENT:   # No such file or directory
            raise
        self.builder.warn('ditaa command %r cannot be run (needed for ditaa '
                          'output), check the ditaa setting' %
                          self.builder.config.ditaa)
        self.builder._ditaa_warned_dot = True
        return None, None
    wentWrong = False
    try:
        # Ditaa may close standard input when an error occurs,
        # resulting in a broken pipe on communicate()
        stdout, stderr = p.communicate(code)
    except OSError, err:
        if err.errno != EPIPE:
            raise
        wentWrong = True
    except IOError, err:
        if err.errno != EINVAL:
            raise
        wentWrong = True
    if wentWrong:
        # in this case, read the standard output and standard error streams
        # directly, to get the error message(s)
        stdout, stderr = p.stdout.read(), p.stderr.read()
        p.wait()
    if p.returncode != 0:
        raise DitaaError('ditaa exited with error:\n[stderr]\n%s\n'
                            '[stdout]\n%s' % (stderr, stdout))
    return outrelfn, outfullfn