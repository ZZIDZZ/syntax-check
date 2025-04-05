public static List<IconCode> getIcons() {
        List<IconCode> list = new ArrayList<>();

        for (IconCode icon : GoogleMaterialDesignIcons.values()) {
            list.add(icon);
        }
        for (IconCode icon : Elusive.values()) {
            list.add(icon);
        }
        for (IconCode icon : Entypo.values()) {
            list.add(icon);
        }
        for (IconCode icon : FontAwesome.values()) {
            list.add(icon);
        }
        for (IconCode icon : Iconic.values()) {
            list.add(icon);
        }
        for (IconCode icon : Typicons.values()) {
            list.add(icon);
        }

        return list;
    }