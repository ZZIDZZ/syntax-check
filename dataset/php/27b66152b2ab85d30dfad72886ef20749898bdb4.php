protected function renderView($view, array $parameters = array())
    {
        if ($this->_oContainer->has('templating')) {
            return $this->_oContainer->get('templating')->render($view, $parameters);
        }

        if (!$this->_oContainer->has('twig')) {
            throw new \LogicException('You can not use the "renderView" method if the Templating Component or the Twig Bundle are not available.');
        }

        return $this->_oContainer->get('twig')->render($view, $parameters);
    }