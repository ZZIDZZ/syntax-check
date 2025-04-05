def dead_code():
    """
    This also finds code you are working on today!
    """
    with safe_cd(SRC):
        if IS_TRAVIS:
            command = "{0} vulture {1}".format(PYTHON, PROJECT_NAME).strip().split()
        else:
            command = "{0} vulture {1}".format(PIPENV, PROJECT_NAME).strip().split()

        output_file_name = "dead_code.txt"
        with open(output_file_name, "w") as outfile:
            env = config_pythonpath()
            subprocess.call(command, stdout=outfile, env=env)

        cutoff = 20
        num_lines = sum(1 for line in open(output_file_name) if line)
        if num_lines > cutoff:
            print("Too many lines of dead code : {0}, max {1}".format(num_lines, cutoff))
            exit(-1)