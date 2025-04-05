public function postManage(Request $request)
    {
        foreach ($request->input('messages') as $message_id) {
            $message = Message::find($message_id);

            if (is_null($message) || !$request->has('action')) {
                continue;
            }

            switch ($request->input('action')) {
                case 'mark_read':
                    if ($message->read == false) {
                        $message->read = true;

                        $message->save();
                    }

                    break;
                case 'mark_unread':
                    if ($message->read == true) {
                        $message->read = false;

                        $message->save();
                    }

                    break;
                case 'delete':
                    $message->delete();

                    break;
            }
        }

        return redirect()->back();
    }