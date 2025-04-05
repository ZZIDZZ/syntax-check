function videojs(id, options, ready) {
  var tag = void 0;

  // Allow for element or ID to be passed in
  // String ID
  if (typeof id === 'string') {
    var players = videojs.getPlayers();

    // Adjust for jQuery ID syntax
    if (id.indexOf('#') === 0) {
      id = id.slice(1);
    }

    // If a player instance has already been created for this ID return it.
    if (players[id]) {

      // If options or ready function are passed, warn
      if (options) {
        log$1.warn('Player "' + id + '" is already initialised. Options will not be applied.');
      }

      if (ready) {
        players[id].ready(ready);
      }

      return players[id];
    }

    // Otherwise get element for ID
    tag = $('#' + id);

    // ID is a media element
  } else {
    tag = id;
  }

  // Check for a useable element
  // re: nodeName, could be a box div also
  if (!tag || !tag.nodeName) {
    throw new TypeError('The element or ID supplied is not valid. (videojs)');
  }

  // Element may have a player attr referring to an already created player instance.
  // If so return that otherwise set up a new player below
  if (tag.player || Player.players[tag.playerId]) {
    return tag.player || Player.players[tag.playerId];
  }

  options = options || {};

  videojs.hooks('beforesetup').forEach(function (hookFunction) {
    var opts = hookFunction(tag, mergeOptions(options));

    if (!isObject(opts) || Array.isArray(opts)) {
      log$1.error('please return an object in beforesetup hooks');
      return;
    }

    options = mergeOptions(options, opts);
  });

  var PlayerComponent = Component.getComponent('Player');
  // If not, set up a new player
  var player = new PlayerComponent(tag, options, ready);

  videojs.hooks('setup').forEach(function (hookFunction) {
    return hookFunction(player);
  });

  return player;
}