function getTimelineArgs(scope) {
        var timelineArgs = {sourceType: scope.sourceType};
        // if this is a valid sourceType...
        if (rules.hasOwnProperty(scope.sourceType)) {
            var sourceRules = rules[scope.sourceType];
            var valid = false;
            // Loop over the required args for the source
            for (var i = 0, len = sourceRules.length; i < len; i++) {
                var rule = sourceRules[i];
                var params = {};
                for (var j = 0, ruleLen = rule.length; j < ruleLen; j++) {
                    if (angular.isDefined(scope[rule[j]])) { // if the rule is present, add it to the params collection
                        params[rule[j]] = scope[rule[j]];
                    }
                }
                if (Object.keys(params).length === ruleLen) {
                    angular.merge(timelineArgs, params);
                    valid = true;
                    break;
                }
            }
            if (!valid) {
                throw new TimelineArgumentException(scope.sourceType, 'args: ' + getSourceRuleString(sourceRules));
            }
        } else {
            throw new TimelineArgumentException(scope.sourceType, 'unknown type');
        }

        return timelineArgs;
    }