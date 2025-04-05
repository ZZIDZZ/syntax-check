public function generate() {

		ob_start();

		foreach ( $this->service['operations'] as $method => $info ) {

			// Add method to info array for more convenient templates
			$info['method'] = $method;

			// Heading
			echo $this->template( $this->tmpl_heading, $info );

			// Code Block start
			echo $this->template( $this->tmpl_code_block_start, $info );

			if ( isset( $info['parameters'] ) ) {

				// Method call (with parameters) start
				echo $this->template( $this->tmpl_method_with_params_start, $info );

				// Parameters
				foreach ( $info['parameters'] as $param => $param_info ) {
					$param_info['param'] = $param;
					echo $this->template( $this->tmpl_method_parameter, $param_info );
				}

				// Method call end
				echo $this->template( $this->tmpl_method_with_params_end, $info );

			}else {
				
				// Method call (no parameters)
				echo $this->template( $this->tmpl_method_without_params, $info );

			}

			// Code Block end
			echo $this->template( $this->tmpl_code_block_end, $info );

		}

		$this->checkTestCoverage();

		$this->docs_markdown = ob_get_clean();

		return $this->docs_markdown;
	}