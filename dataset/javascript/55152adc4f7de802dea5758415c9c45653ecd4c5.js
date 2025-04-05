function requireBrocfile(brocfilePath) {
  let brocfile;

  if (brocfilePath.match(/\.ts$/)) {
    try {
      require.resolve('ts-node');
    } catch (e) {
      throw new Error(`Cannot find module 'ts-node', please install`);
    }

    try {
      require.resolve('typescript');
    } catch (e) {
      throw new Error(`Cannot find module 'typescript', please install`);
    }

    // Register ts-node typescript compiler
    require('ts-node').register(); // eslint-disable-line node/no-unpublished-require

    // Load brocfile via ts-node
    brocfile = require(brocfilePath);
  } else {
    // Load brocfile via esm shim
    brocfile = esmRequire(brocfilePath);
  }

  // ESM `export default X` is represented as module.exports = { default: X }
  if (brocfile !== null && typeof brocfile === 'object' && brocfile.hasOwnProperty('default')) {
    brocfile = brocfile.default;
  }

  return brocfile;
}