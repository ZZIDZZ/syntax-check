public function index()
    {
        $params = request('search');

        $posts = Post::search($params)->get();
        $tags = Tag::search($params)->get();
        $users = User::search($params)->get();

        return view('canvas::backend.search.index', compact('posts', 'tags', 'users'));
    }