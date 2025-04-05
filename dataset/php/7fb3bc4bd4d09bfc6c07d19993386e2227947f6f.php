public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->getStatusCode() !== Response::HTTP_NOT_FOUND)
            return $response;

        return $this->redirector->getRedirectFor($request) ?: $response;
    }