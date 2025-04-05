protected boolean evaluate(final UUID attributeDefinitionUuid, final AttributeFilterExpression attributeFilter, final Map<UUID, String> eventAttributes, final List<AttributeDefinition> attributeDefinitions) throws ParseException {
		if (LOG.isTraceEnabled()) {
			LOG.entry(attributeDefinitionUuid, attributeFilter, eventAttributes, attributeDefinitions);
		}
		// Find a matching attribute
		final String attributeValue = eventAttributes.get(attributeDefinitionUuid);
		if (attributeValue == null) {
			// No attribute value to match attribute filter.
			if (LOG.isTraceEnabled()) {
				LOG.trace("An attributeValue was not specified for this attribute definition.");
				LOG.exit(false);
			}
			return false;
		}
		
		// Find the Attribute definition that matches our filter.
		final AttributeDefinition attributeDefinition = getApplicableAttributeDefinition(attributeDefinitionUuid, attributeDefinitions);
		
		if (attributeDefinition == null) {
			// Really shouldn't have any filters defined for attributes that don't exist.
			if (LOG.isTraceEnabled()) {
				LOG.trace("The attributeDefinition did not exist.");
				LOG.exit(false);
			}
			return false;
		}
		
		final Unit unit = attributeDefinition.getUnits();
		try {
			boolean result = unit.evaluate(attributeFilter.getOperator(), attributeValue, attributeFilter.getOperand());
			if (LOG.isTraceEnabled()) {
				LOG.exit(result);
			}
			return result;
		} catch (ParseException e) {
			if (LOG.isTraceEnabled()) {
				LOG.throwing(e);
			}
			throw e;
		}
	}