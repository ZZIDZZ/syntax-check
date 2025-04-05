def create_complete_files(climan, path, cmd, *cmds, zsh_sourceable=False):
    """Create completion files for bash and zsh.

    Args:
        climan (:class:`~loam.cli.CLIManager`): CLI manager.
        path (path-like): directory in which the config files should be
            created. It is created if it doesn't exist.
        cmd (str): command name that should be completed.
        cmds (str): extra command names that should be completed.
        zsh_sourceable (bool): if True, the generated file will contain an
            explicit call to ``compdef``, which means it can be sourced
            to activate CLI completion.
    """
    path = pathlib.Path(path)
    zsh_dir = path / 'zsh'
    if not zsh_dir.exists():
        zsh_dir.mkdir(parents=True)
    zsh_file = zsh_dir / '_{}.sh'.format(cmd)
    bash_dir = path / 'bash'
    if not bash_dir.exists():
        bash_dir.mkdir(parents=True)
    bash_file = bash_dir / '{}.sh'.format(cmd)
    climan.zsh_complete(zsh_file, cmd, *cmds, sourceable=zsh_sourceable)
    climan.bash_complete(bash_file, cmd, *cmds)