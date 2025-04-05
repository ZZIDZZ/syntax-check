public function processOpen(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        parent::processOpen($phpcsFile, $stackPtr);

        $tokens = $phpcsFile->getTokens();

        if ($tokens[($stackPtr - 1)]['code'] === T_WHITESPACE) {
            $prevContent = $tokens[($stackPtr - 1)]['content'];
            if ($prevContent !== $phpcsFile->eolChar) {
                $blankSpace = substr($prevContent, strpos($prevContent, $phpcsFile->eolChar));
                $spaces     = strlen($blankSpace);

                if ($tokens[($stackPtr - 2)]['code'] !== T_ABSTRACT
                    && $tokens[($stackPtr - 2)]['code'] !== T_FINAL
                ) {
                    if ($spaces !== 0) {
                        $type  = strtolower($tokens[$stackPtr]['content']);
                        $error = 'Expected 0 spaces before %s keyword; %s found';
                        $data  = array(
                            $type,
                            $spaces,
                        );

                        $fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpaceBeforeKeyword', $data);
                        if ($fix === true) {
                            $phpcsFile->fixer->replaceToken(($stackPtr - 1), '');
                        }
                    }
                }
            }//end if
        }//end if
        //ONGR we do not allow blank line after an opening brace.
        $curlyBrace = $tokens[$stackPtr]['scope_opener'];
        $i = 1;
        while ($tokens[($curlyBrace + $i)]['code'] === T_WHITESPACE && $i < count($tokens)) {
            $i++;
        }
        $blankLineCount = ($tokens[($curlyBrace + $i)]['line'] - $tokens[$curlyBrace]['line']) - 1;
        if ($blankLineCount > 0) {
            $data = [$blankLineCount];
            $error = 'Expected no blank lines after an opening brace, %s found';
            $phpcsFile->addError($error, $curlyBrace, 'OpenBraceBlankLines', $data);
        }

    }