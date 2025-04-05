function getParametersFromRightHandSideOfAssignment(rightHandSide) {
            while (rightHandSide.kind === 172 /* ParenthesizedExpression */) {
                rightHandSide = rightHandSide.expression;
            }
            switch (rightHandSide.kind) {
                case 173 /* FunctionExpression */:
                case 174 /* ArrowFunction */:
                    return rightHandSide.parameters;
                case 186 /* ClassExpression */:
                    for (var _i = 0, _a = rightHandSide.members; _i < _a.length; _i++) {
                        var member = _a[_i];
                        if (member.kind === 144 /* Constructor */) {
                            return member.parameters;
                        }
                    }
                    break;
            }
            return emptyArray;
        }