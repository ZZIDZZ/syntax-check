func initConfig() {
	if cfgFile != "" { // enable ability to specify config file via flag
		Viper.SetConfigFile(cfgFile)
	}

	Viper.SetConfigName("config") // name of config file (without extension)
	Viper.AddConfigPath("$HOME")  // adding home directory as first search path
	Viper.AddConfigPath("./")     // adding local directory as second search path
	Viper.AutomaticEnv()          // read in environment variables that match

	// If a config file is found, read it in.
	if err := Viper.ReadInConfig(); err == nil {
		fmt.Println("Using config file:", Viper.ConfigFileUsed())
	}
}