protected function renderValidationSerializerAsJsonApi(ValidationBaseSerializerException $error) {
		// Add a response type for JSON API
		$this->controller->response->type(array('jsonapi' => 'application/vnd.api+json'));
		// Set the controller to response as JSON API
		$this->controller->response->type('jsonapi');
		$this->addHttpCodes();
		$this->controller->response->statusCode($error->status());

		// set the errors object to match JsonApi's standard
		$errors = array(
			'errors' => array(
				array(
					'id' => h($error->id()),
					'href' => h($error->href()),
					'status' => h($error->status()),
					'code' => h($error->code()),
					'title' => h($error->title()),
					'detail' => h($error->validationErrors()),
					'links' => h($error->links()),
					'paths' => h($error->paths()),
				),
			),
		);

		// json encode the errors
		$jsonEncodedErrors = json_encode($errors);

		// set the body to the json encoded errors
		$this->controller->response->body($jsonEncodedErrors);
		return $this->controller->response->send();
	}