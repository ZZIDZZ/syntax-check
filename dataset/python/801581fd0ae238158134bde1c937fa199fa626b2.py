def paths(self):
        '''
        given a basedir, yield all test modules paths recursively found in
        basedir that are test modules

        return -- generator
        '''
        module_name = getattr(self, 'module_name', '')
        module_prefix = getattr(self, 'prefix', '')
        filepath = getattr(self, 'filepath', '')

        if filepath:
            if os.path.isabs(filepath):
                yield filepath

            else:
                yield os.path.join(self.basedir, filepath)

        else:
            if module_prefix:
                basedirs = self._find_prefix_paths(self.basedir, module_prefix)
            else:
                basedirs = [self.basedir]

            for basedir in basedirs:
                try:
                    if module_name:
                        path = self._find_module_path(basedir, module_name)

                    else:
                        path = basedir

                    if os.path.isfile(path):
                        logger.debug('Module path: {}'.format(path))
                        yield path

                    else:
                        seen_paths = set()
                        for root, dirs, files in self.walk(path):
                            for basename in files:
                                if basename.startswith("__init__"):
                                    if self._is_module_path(root):
                                        filepath = os.path.join(root, basename)
                                        if filepath not in seen_paths:
                                            logger.debug('Module package path: {}'.format(filepath))
                                            seen_paths.add(filepath)
                                            yield filepath

                                else:
                                    fileroot = os.path.splitext(basename)[0]
                                    for pf in self.module_postfixes:
                                        if fileroot.endswith(pf):
                                            filepath = os.path.join(root, basename)
                                            if filepath not in seen_paths:
                                                logger.debug('Module postfix path: {}'.format(filepath))
                                                seen_paths.add(filepath)
                                                yield filepath

                                    for pf in self.module_prefixes:
                                        if fileroot.startswith(pf):
                                            filepath = os.path.join(root, basename)
                                            if filepath not in seen_paths:
                                                logger.debug('Module prefix path: {}'.format(filepath))
                                                seen_paths.add(filepath)
                                                yield filepath

                except IOError as e:
                    # we failed to find a suitable path
                    logger.warning(e, exc_info=True)
                    pass