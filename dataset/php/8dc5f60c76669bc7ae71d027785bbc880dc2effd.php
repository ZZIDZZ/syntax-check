public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error(trans('l5starter::messages.404_not_found'));

            return redirect(route('admin.users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success(trans('l5starter::messages.delete.success'));

        return redirect(route('admin.users.index'));
    }