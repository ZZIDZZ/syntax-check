def get_editor(filepath):
		"""
		Give preference to an XML_EDITOR or EDITOR defined in the
		environment. Otherwise use notepad on Windows and edit on other
		platforms.
		"""
		default_editor = ['edit', 'notepad'][sys.platform.startswith('win32')]
		return os.environ.get(
			'XML_EDITOR',
			os.environ.get('EDITOR', default_editor),
		)