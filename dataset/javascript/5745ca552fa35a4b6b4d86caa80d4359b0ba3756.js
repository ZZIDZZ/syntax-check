function(repo, branchname) {
	return ensureRemote(repo).then(function() {
		return p.spawn('git', ['push', program.remote, 'HEAD:refs/heads/' + branchname], CHILD_IGNORE);
	});
}