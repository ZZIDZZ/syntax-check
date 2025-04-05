public function getLogout(Request $request)
    {
        $request->session()->flush();

        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }