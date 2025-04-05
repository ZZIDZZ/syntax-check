function validateType(type, value, silent) {
	  if (silent === void 0) {
	    silent = false;
	  }

	  var typeToCheck = type;
	  var valid = true;
	  var expectedType;

	  if (!isPlainObject_1(type)) {
	    typeToCheck = {
	      type: type
	    };
	  }

	  var namePrefix = typeToCheck._vueTypes_name ? typeToCheck._vueTypes_name + ' - ' : '';

	  if (hasOwn.call(typeToCheck, 'type') && typeToCheck.type !== null) {
	    if (isArray(typeToCheck.type)) {
	      valid = typeToCheck.type.some(function (type) {
	        return validateType(type, value, true);
	      });
	      expectedType = typeToCheck.type.map(function (type) {
	        return getType(type);
	      }).join(' or ');
	    } else {
	      expectedType = getType(typeToCheck);

	      if (expectedType === 'Array') {
	        valid = isArray(value);
	      } else if (expectedType === 'Object') {
	        valid = isPlainObject_1(value);
	      } else if (expectedType === 'String' || expectedType === 'Number' || expectedType === 'Boolean' || expectedType === 'Function') {
	        valid = getNativeType(value) === expectedType;
	      } else {
	        valid = value instanceof typeToCheck.type;
	      }
	    }
	  }

	  if (!valid) {
	    silent === false && warn(namePrefix + "value \"" + value + "\" should be of type \"" + expectedType + "\"");
	    return false;
	  }

	  if (hasOwn.call(typeToCheck, 'validator') && isFunction(typeToCheck.validator)) {
	    // swallow warn
	    var oldWarn;

	    if (silent) {
	      oldWarn = warn;
	      warn = noop;
	    }

	    valid = typeToCheck.validator(value);
	    oldWarn && (warn = oldWarn);
	    if (!valid && silent === false) warn(namePrefix + "custom validation failed");
	    return valid;
	  }

	  return valid;
	}