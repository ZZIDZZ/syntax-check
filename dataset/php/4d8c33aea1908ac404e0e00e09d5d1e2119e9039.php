public function delete($permissionId)
    {
        try {
            $permission = PermissionProvider::findById($permissionId);
            $permission->delete();
        } catch (\MrJuliuss\Syntara\Models\Permissions\PermissionNotFoundException $e) {
            return Response::json(array('deletePermission' => false, 'message' => trans('syntara::permissions.messages.not-found'), 'messageType' => 'danger'));
        }

        return Response::json(array('deletePermission' => true, 'message' => trans('syntara::permissions.messages.remove-success'), 'messageType' => 'success'));
    }