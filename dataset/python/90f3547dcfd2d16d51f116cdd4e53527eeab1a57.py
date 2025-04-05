def select_python_parser(parser=None):
        """
        Select default parser for loading and refactoring steps. Passing `redbaron` as argument
        will select the old paring engine from v0.3.3

        Replacing the redbaron parser was necessary to support Python 3 syntax. We have tried our
        best to make sure there is no user impact on users. However, there may be regressions with
        new parser backend.

        To revert to the old parser implementation, add `GETGAUGE_USE_0_3_3_PARSER=true` property
        to the `python.properties` file in the `<PROJECT_DIR>/env/default directory.

        This property along with the redbaron parser will be removed in future releases.
        """
        if parser == 'redbaron' or os.environ.get('GETGAUGE_USE_0_3_3_PARSER'):
            PythonFile.Class = RedbaronPythonFile
        else:
            PythonFile.Class = ParsoPythonFile