function bemNames(entitys, delimiters) {
  var resultString = '';
  var names = entitys || { mods: {}, mixin: '' };
  var delims = _extends({
    ns: '',
    el: '__',
    mod: '--',
    modVal: '-'
  }, delimiters);
  var mixin = isString(names.mixin) ? ' ' + names.mixin : '';

  if (!names.block) return '';
  resultString = delims.ns ? delims.ns + names.block : names.block;

  if (names.el) resultString += delims.el + names.el;

  if (isPObject(names.mods)) {
    resultString += Object.keys(names.mods).reduce(function (prev, name) {
      var val = names.mods[name];
      /* eslint-disable no-param-reassign */
      if (val === true) {
        prev += ' ' + resultString + delims.mod + name;
      } else if (isString(val) || isNumber(val)) {
        prev += ' ' + resultString + delims.mod + name + delims.modVal + names.mods[name];
      }
      /* eslint-enable no-param-reassign */

      return prev;
    }, '');
  }
  return resultString + mixin;
}