public SldGwtServiceAsync createSldGwtServiceAsync() {

		this.service = GWT.create(SldGwtService.class);

		ServiceDefTarget endpoint = (ServiceDefTarget) service;
		endpoint.setServiceEntryPoint(GWT.getHostPageBaseURL() + "d/sldTemplates");

		return service;

	}