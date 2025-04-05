function writeConfig(adapterName, path, config){
	var adapter = getAdapterInstance(adapterName);
	return adapter.configWriter(normalizeAdapterConfigPath(adapter, path), config);
}