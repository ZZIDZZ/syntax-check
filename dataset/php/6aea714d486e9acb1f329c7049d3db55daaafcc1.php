public function init()
    {
        $swears = array('fu+ck', 'sh+i+t', 'cu+nt', 'co+ck');
        $swear_jar = array();

        // Don't say bad words, kids.
        $re = '/' . implode('|', $swears) . '/i';
        $this->bot->onChannel($re, function(Event $event) use (&$swear_jar) {
            $cost = 0.25;
            $who = $event->getRequest()->getSendingUser();
            if (!isset($swear_jar[$who])) {
                $swear_jar[$who] = 0;
            }

            $price = ($swear_jar[$who] += $cost);
            $event->addResponse(
                Response::msg(
                    $event->getRequest()->getSource(),
                    sprintf("Mind your tongue $who! Now you owe \$%.2f to the swear jar.", $price)
            ));
        });
    }