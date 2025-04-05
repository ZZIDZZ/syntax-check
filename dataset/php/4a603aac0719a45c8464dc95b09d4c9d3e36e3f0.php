public static function evalKeys(CommandInterface $command, $prefix)
    {
        if ($arguments = $command->getArguments()) {
            $command->setRawArguments($arguments);
        }
    }