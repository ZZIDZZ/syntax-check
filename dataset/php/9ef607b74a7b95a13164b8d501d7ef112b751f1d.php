public function destroy($id)
    {
        $role = $this->roleRepository->findWithoutFail($id);

        if (empty($role)) {
            \Flash::error(trans('l5starter::messages.404_not_found'));

            return redirect(route('admin.roles.index'));
        }

        $this->roleRepository->delete($id);

        \Flash::success(trans('l5starter::messages.delete.success'));

        return redirect(route('admin.roles.index'));
    }