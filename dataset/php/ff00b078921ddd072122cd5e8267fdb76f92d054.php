private function updateButtons($dstFile){
        $nodes = (new \DOMXPath($dstFile))->query("//div[@class='layout']/table/tr[contains(@class, 'scenarioRow')]");
        for($i=2;$i<$nodes->length;$i+=2){
            $n = $i/2 + 1;
            $p = $nodes->item($i)->childNodes->item(1)->childNodes->item(1);
            $table = $nodes->item($i+1)->childNodes->item(1)->childNodes->item(1);
            $p->setAttribute('onclick',"showHide('$n', this)");
            $table->setAttribute('id',"stepContainer".$n);
        }
    }