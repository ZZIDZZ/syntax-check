private void generateNamedUsageParameterGetter(CtClass profileConcreteClass) {
		String methodName = "getUsageParameterSet";
		for (CtMethod ctMethod : profileConcreteClass.getMethods()) {
			if (ctMethod.getName().equals(methodName)) {				
				try {
					// copy method, we can't just add body becase it is in super
					// class and does not sees profileObject field
					CtMethod ctMethodCopy =  CtNewMethod.copy(ctMethod, profileConcreteClass, null);
					// create the method body
					String methodBody = "{ return ($r)"
						+ ClassGeneratorUtils.MANAGEMENT_HANDLER
						+ ".getUsageParameterSet(profileObject,$1); }";
					if (logger.isTraceEnabled())
						logger.trace("Implemented method " + methodName
								+ " , body = " + methodBody);
					ctMethodCopy.setBody(methodBody);
					profileConcreteClass.addMethod(ctMethodCopy);
				} catch (CannotCompileException e) {
					throw new SLEEException(e.getMessage(), e);
				}				
			}
		}
	}