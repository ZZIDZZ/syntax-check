private function buildParameterFilterWidgets(
        $arrJumpTo,
        FrontendFilterOptions $objFrontendFilterOptions,
        $objAttribute,
        $strParamName,
        $arrOptions,
        $arrCount,
        $arrParamValue,
        $arrMyFilterUrl
    ) {
        return  array(
            $this->getParamName() => $this->prepareFrontendFilterWidget(
                array(
                    'label' => array(
                        ($this->get('label') ? $this->get('label') : $objAttribute->getName()),
                        'GET: ' . $strParamName
                    ),
                    'inputType' => 'tags',
                    'options' => $arrOptions,
                    'count' => $arrCount,
                    'showCount' => $objFrontendFilterOptions->isShowCountValues(),
                    'eval' => array(
                        'includeBlankOption' => (
                            $this->get('blankoption')
                            && !$objFrontendFilterOptions->isHideClearFilter()
                        ),
                        'blankOptionLabel'   => &$GLOBALS['TL_LANG']['metamodels_frontendfilter']['do_not_filter'],
                        'multiple'           => true,
                        'colname'            => $objAttribute->getColName(),
                        'urlparam'           => $strParamName,
                        'onlyused'           => $this->get('onlyused'),
                        'onlypossible'       => $this->get('onlypossible'),
                        'template'           => $this->get('template')
                    ),
                    // We need to implode again to have it transported correctly in the frontend filter.
                    'urlvalue' => !empty($arrParamValue) ? implode(',', $arrParamValue) : ''
                ),
                $arrMyFilterUrl,
                $arrJumpTo,
                $objFrontendFilterOptions
            )
        );
    }