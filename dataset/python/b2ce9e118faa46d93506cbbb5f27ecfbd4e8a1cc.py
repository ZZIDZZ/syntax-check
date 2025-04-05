def exclusive_ns(guard: StateGuard[A], desc: str, thunk: Callable[..., NS[A, B]], *a: Any) -> Do:
    '''this is the central unsafe function, using a lock and updating the state in `guard` in-place.
    '''
    yield guard.acquire()
    log.debug2(lambda: f'exclusive: {desc}')
    state, response = yield N.ensure_failure(thunk(*a).run(guard.state), guard.release)
    yield N.delay(lambda v: unsafe_update_state(guard, state))
    yield guard.release()
    log.debug2(lambda: f'release: {desc}')
    yield N.pure(response)