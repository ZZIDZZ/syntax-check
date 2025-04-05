async function getConfig(context, fileName, defaultConfig, deepMergeOptions) {
  const filePath = path.posix.join(CONFIG_PATH, fileName);
  const params = context.repo({
    path: filePath,
  });

  const config = await loadYaml(context, params);
  let baseRepo;
  if (config == null) {
    baseRepo = DEFAULT_BASE;
  } else if (config != null && BASE_KEY in config) {
    baseRepo = config[BASE_KEY];
    delete config[BASE_KEY];
  }

  let baseConfig;
  if (baseRepo) {
    const baseParams = getBaseParams(params, baseRepo);
    baseConfig = await loadYaml(context, baseParams);
  }

  if (config == null && baseConfig == null && !defaultConfig) {
    return null;
  }

  return deepMergeConfigs(
    [defaultConfig, baseConfig, config],
    deepMergeOptions
  );
}