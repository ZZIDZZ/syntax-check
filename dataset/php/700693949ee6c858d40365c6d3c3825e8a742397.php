public function &addAjaxTab($tabName, $tabUrl, $active = false)
    {
        $this->tabs[$tabName] = ['ajax' => $tabUrl];
        if ($active) {
            $this->activeTab = $tabName;
        }
        \Ease\Shared::webPage()->addJavaScript('
$(\'#'.$this->getTagID().' a\').click(function (e) {
	e.preventDefault();

	var url = $(this).attr("data-url");
  	var href = this.hash;
  	var pane = $(this);

	// ajax load from data-url
	$(href).load(url,function(result){
	    pane.tab(\'show\');
	});
});
            
');
        return $this->tabs[$tabName];
    }