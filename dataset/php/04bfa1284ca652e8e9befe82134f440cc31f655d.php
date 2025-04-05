public function register() {
		$this->assignment_tokens = Tokens::$assignmentTokens;
		unset( $this->assignment_tokens[ \T_DOUBLE_ARROW ] );

		$starters                        = Tokens::$booleanOperators;
		$starters[ \T_SEMICOLON ]        = \T_SEMICOLON;
		$starters[ \T_OPEN_PARENTHESIS ] = \T_OPEN_PARENTHESIS;
		$starters[ \T_INLINE_ELSE ]      = \T_INLINE_ELSE;

		$this->condition_start_tokens = $starters;

		return array(
			\T_IF,
			\T_ELSEIF,
			\T_FOR,
			\T_SWITCH,
			\T_CASE,
			\T_WHILE,
			\T_INLINE_THEN,
		);
	}