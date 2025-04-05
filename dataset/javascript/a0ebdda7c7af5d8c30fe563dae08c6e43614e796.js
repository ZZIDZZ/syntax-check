function buildCommands (commands) {
  var result = [];

  commands.forEach(function (command) {
    result.push([
      command.name,
      command.desc || ''
    ]);
  });

  return table(result);
}