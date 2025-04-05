function ImpulseBin() {
  this.settings = {
    adapter: 'commander',
    quietOption: 'quiet',
    requiredOptionTmpl: '--%s is required',
    verboseOption: 'verbose',
    verboseLogName: '[verbose]',
    stdoutLogName: '[stdout]',
    stderrLogName: '[stderr]'
  };

  this.console = require('long-con').create();

  // Assigned in run():
  this.adapter = null;
  this.options = null;
  this.provider = null;
}