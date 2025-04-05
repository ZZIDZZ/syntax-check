def get_data(path):
    """
    Returns data from a package directory.
    'path' should be an absolute path.
    """
    # Run the imported setup to get the metadata.
    with FakeContext(path):
        with SetupMonkey() as sm:
            try:
                distro = run_setup('setup.py', stop_after='config')

                metadata = {'_setuptools': sm.used_setuptools}

                for k, v in distro.metadata.__dict__.items():
                    if k[0] == '_' or not v:
                        continue
                    if all(not x for x in v):
                        continue
                    metadata[k] = v

                if sm.used_setuptools:
                    for extras in ['cmdclass', 'zip_safe', 'test_suite']:
                        v = getattr(distro, extras, None)
                        if v is not None and v not in ([], {}):
                            metadata[extras] = v

            except ImportError as e:
                # Either there is no setup py, or it's broken.
                logging.exception(e)
                metadata = {}

    return metadata