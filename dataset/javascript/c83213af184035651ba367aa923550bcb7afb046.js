function(target, name, reciever) {
            // Check for direct properties to satisfy internal attribute and function calls
            if (model[name]) {
                return model[name];
            }

            // It's not a property, check for internal attribute value
            return model.get(name);
        }