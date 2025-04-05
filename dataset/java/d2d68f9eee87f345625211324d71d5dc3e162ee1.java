public static void installInAllColumns(JTable table, int alignment) {
        // We don't want to set up completely new cell renderers: rather, we want to use the existing ones but just
        // change their alignment.
        for (int colViewIndex = 0; colViewIndex < table.getColumnCount(); ++colViewIndex) {
            installInOneColumn(table, colViewIndex, alignment);
        }
    }