func flagAsEnv(name string) string {
	name = strings.ToUpper(EnvPrefix + name)
	name = strings.Replace(name, ".", "_", -1)
	name = strings.Replace(name, "-", "_", -1)
	return name
}