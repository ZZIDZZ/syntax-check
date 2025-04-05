function listUnmetRequirements (name, failedRequirements) {
    events.emit('warn', 'Unmet project requirements for latest version of ' + name + ':');

    failedRequirements.forEach(function (req) {
        events.emit('warn', '    ' + req.dependency + ' (' + req.installed + ' in project, ' + req.required + ' required)');
    });
}