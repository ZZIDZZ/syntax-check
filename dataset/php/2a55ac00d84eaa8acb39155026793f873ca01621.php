protected function throwException($message, Node $relatedNode = null)
    {

        if ($relatedNode)
            $message .= "\n(".$relatedNode->type
                .' at '.$relatedNode->line
                .':'.$relatedNode->offset.')';

        if (!empty($this->files))
            $message .= "\nError occured in: [".end($this->files).']';

        throw new Exception(
            "Failed to compile Pug: $message"
        );
    }