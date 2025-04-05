def __init(self, project, path, force, init_languages):
        status = {}
        """
        REFACTOR status to project init result ENUM
        jelenleg ha a project init False, akkor torlunk minden adatot a projectrol
        de van egy atmenet, mikor csak a lang init nem sikerult
        erre valo jelenleg a status. ez rossz
        """

        project.init(path, status, force, init_languages = init_languages)

        failed = []
        for name, val in list(status.items()):
            if val is False and name not in failed:
                failed.append(name)

        return failed