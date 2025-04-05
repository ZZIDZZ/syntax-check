protected static boolean cleanFolder(File parentFolder, FileFilter filter, boolean continueOnError,
			boolean deleteParentFolder) {
		if (!parentFolder.exists()) {
			return true;
		}
		if (filter == null)
			filter = ACCEPT_ALL_FILTER;
		log.debug("Cleaning folder " + parentFolder.toString());
		final File[] contents = parentFolder.listFiles(filter);
		for (int j = 0; j < contents.length; j++) {
			final File file = contents[j];
			if (file.isDirectory()) {
				if (!cleanFolder(file, filter, continueOnError, true) && !continueOnError)
					return false;
			} else {
				if (!file.delete()) {
					log.warn("Couldn't delete " + file.getAbsolutePath());
					if (!continueOnError)
						return false;
				}
			}
		}
		if (deleteParentFolder) {
			if (parentFolder.list().length == 0 && !parentFolder.delete()) {
				log.warn("Couldn't delete " + parentFolder.getAbsolutePath());
				return false;
			}
		}
		return true;
	}