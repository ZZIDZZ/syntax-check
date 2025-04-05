function(breakpoints, spacingScale) {
    return _.map(breakpoints, function(breakpointValue, breakpointKey) {
        let mediaQuery = postcss.atRule({
            name: 'media',
            params: breakpointValue,
        })

        let rules = _.flatMap(spacingScale, function(scaleValue, scaleKey) {
            return _.map(helpers, function(helperValues, helperKey) {
                return makeFunctionalRule(
                    `.${breakpointKey}-${helperKey}${scaleKey}`,
                    helperValues,
                    scaleValue
                )
            })
        })

        return mediaQuery.append(rules)
    })
}