public function checkTable(Request $request)
    {
        if ($request->table) {
            if (Schema::hasTable($request->table)) {
                return response()->json((object) [
                    'type'    => 'error',
                    'message' => 'Table exists Already',
                ]);
            } else {
                return response()->json((object) [
                    'type'    => 'success',
                    'message' => 'Table Name Available',
                ]);
            }
        } else {
            return response()->json((object) [
                'type'    => 'error',
                'message' => 'Please provide some value',
            ]);
        }
    }