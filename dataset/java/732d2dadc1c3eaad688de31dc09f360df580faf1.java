private static void sanitizeRadioControls(FormElement form)
	{
		Map<String, Element> controlsByName = new HashMap<String, Element>();
		
		for (Element control : form.elements())
		{
			// cannot use Element.select since Element.hashCode collapses like elements
			if ("radio".equals(control.attr("type")) && control.hasAttr("checked"))
			{
				String name = control.attr("name");
				
				if (controlsByName.containsKey(name))
				{
					controlsByName.get(name).attr("checked", false);
				}
				
				controlsByName.put(name, control);
			}
		}
	}