func getStage() (stage int, advanceStage func() error, resetEnv func() error) {
	var origValue string
	stage = 0

	daemonStage := os.Getenv(stageVar)
	stageTag := strings.SplitN(daemonStage, ":", 2)
	stageInfo := strings.SplitN(stageTag[0], "/", 3)

	if len(stageInfo) == 3 {
		stageStr, tm, check := stageInfo[0], stageInfo[1], stageInfo[2]

		hash := sha1.New()
		hash.Write([]byte(stageStr + "/" + tm + "/"))

		if check != hex.EncodeToString(hash.Sum([]byte{})) {
			// This whole chunk is original data
			origValue = daemonStage
		} else {
			stage, _ = strconv.Atoi(stageStr)

			if len(stageTag) == 2 {
				origValue = stageTag[1]
			}
		}
	} else {
		origValue = daemonStage
	}

	advanceStage = func() error {
		base := fmt.Sprintf("%d/%09d/", stage+1, time.Now().Nanosecond())
		hash := sha1.New()
		hash.Write([]byte(base))
		tag := base + hex.EncodeToString(hash.Sum([]byte{}))

		if err := os.Setenv(stageVar, tag+":"+origValue); err != nil {
			return fmt.Errorf("can't set %s: %s", stageVar, err)
		}
		return nil
	}
	resetEnv = func() error {
		return os.Setenv(stageVar, origValue)
	}

	return stage, advanceStage, resetEnv
}