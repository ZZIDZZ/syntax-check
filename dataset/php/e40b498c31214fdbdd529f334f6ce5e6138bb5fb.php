protected function parseError(\LibXMLError $error)
    {
        $msg = '';
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $msg .= 'Warning ' . $error->code . ': ';
                break;
            case LIBXML_ERR_FATAL:
                $msg .= 'Fatal error: ' . $error->code . ': ';
                break;
            case LIBXML_ERR_ERROR:
            default:
                $msg .= 'Error ' . $error->code . ': ';
                break;
        }

        $msg .= trim($error->message) . PHP_EOL .
                '  Line: ' . $error->line . PHP_EOL .
                'Column: ' . $error->column;

        if ($error->file) {
            $msg .= PHP_EOL . '  File: ' . $error->file;
        }

        return $msg;
    }