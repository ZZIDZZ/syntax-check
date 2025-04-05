def fold_map(self, fa: F[A], z: B, f: Callable[[A], B], g: Callable[[Z, B], Z]=operator.add) -> Z:
        ''' map `f` over the traversable, then fold over the result
        using the supplied initial element `z` and operation `g`,
        defaulting to addition for the latter.
        '''
        mapped = Functor.fatal(type(fa)).map(fa, f)
        return self.fold_left(mapped)(z)(g)