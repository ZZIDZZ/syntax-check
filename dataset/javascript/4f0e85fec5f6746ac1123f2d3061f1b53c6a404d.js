function(topCallFrame, callFrameId, functionObjectId, scopeNumber, variableName, newValueJsonString)
    {
        try {
            var newValueJson = /** @type {!RuntimeAgent.CallArgument} */ (InjectedScriptHost.eval("(" + newValueJsonString + ")"));
            var resolvedValue = this._resolveCallArgument(newValueJson);
            if (typeof callFrameId === "string") {
                var callFrame = this._callFrameForId(topCallFrame, callFrameId);
                if (!callFrame)
                    return "Could not find call frame with given id";
                callFrame.setVariableValue(scopeNumber, variableName, resolvedValue)
            } else {
                var parsedFunctionId = this._parseObjectId(/** @type {string} */ (functionObjectId));
                var func = this._objectForId(parsedFunctionId);
                if (typeof func !== "function")
                    return "Could not resolve function by id";
                InjectedScriptHost.setFunctionVariableValue(func, scopeNumber, variableName, resolvedValue);
            }
        } catch (e) {
            return toString(e);
        }
        return undefined;
    }