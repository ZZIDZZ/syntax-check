public function conclusion($handleTable, $filterTable)
    {
        $enter = self::ENTER;
        $handleNumber = count($handleTable);
        $filterNumber = count($filterTable);
        $handleTableString = implode($handleTable, ', ');
        $filterTableString = implode($filterTable, ', ');
        $tables = Yii::t('dump', 'Tables');
        $handle = Yii::t('dump', 'Handle');
        $filter = Yii::t('dump', 'Filter');


        $header = <<<HEADER
/**********************************/
/************ Conclusion **********/
/**********************************/

HEADER;

        $footer = <<<FOOTER
        
/************ Conclusion *********/$enter
FOOTER;

        $handle = <<<HANDLE
/*** $handle $handleNumber $tables: */
>>> $handleTableString$enter
HANDLE;

        $filter = <<<FILTER
/*** $filter $filterNumber $tables: */
>>> $filterTableString
FILTER;


        $this->stdout($header, 0, Console::FG_YELLOW);
        $this->stdout($handle, Console::BOLD, Console::FG_YELLOW);
        $this->stdout($filter, Console::BOLD, Console::FG_YELLOW);
        $this->stdout($footer, 0, Console::FG_GREEN);
    }