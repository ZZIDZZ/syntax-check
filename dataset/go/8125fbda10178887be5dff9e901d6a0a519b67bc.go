func getGCSDirsForPR(config *config.Config, org, repo string, pr int) (map[string]sets.String, error) {
	toSearch := make(map[string]sets.String)
	fullRepo := org + "/" + repo
	presubmits, ok := config.Presubmits[fullRepo]
	if !ok {
		return toSearch, fmt.Errorf("couldn't find presubmits for %q in config", fullRepo)
	}

	for _, presubmit := range presubmits {
		var gcsConfig *v1.GCSConfiguration
		if presubmit.DecorationConfig != nil && presubmit.DecorationConfig.GCSConfiguration != nil {
			gcsConfig = presubmit.DecorationConfig.GCSConfiguration
		} else {
			// for undecorated jobs assume the default
			gcsConfig = config.Plank.DefaultDecorationConfig.GCSConfiguration
		}

		gcsPath, _, _ := gcsupload.PathsForJob(gcsConfig, &downwardapi.JobSpec{
			Type: v1.PresubmitJob,
			Job:  presubmit.Name,
			Refs: &v1.Refs{
				Repo: repo,
				Org:  org,
				Pulls: []v1.Pull{
					{Number: pr},
				},
			},
		}, "")
		gcsPath, _ = path.Split(path.Clean(gcsPath))
		if _, ok := toSearch[gcsConfig.Bucket]; !ok {
			toSearch[gcsConfig.Bucket] = sets.String{}
		}
		toSearch[gcsConfig.Bucket].Insert(gcsPath)
	}
	return toSearch, nil
}