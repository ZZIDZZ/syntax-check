private GeoPackageMetadata createGeoPackageMetadata(Cursor cursor) {
        GeoPackageMetadata metadata = new GeoPackageMetadata();
        metadata.setId(cursor.getLong(0));
        metadata.setName(cursor.getString(1));
        metadata.setExternalPath(cursor.getString(2));
        return metadata;
    }