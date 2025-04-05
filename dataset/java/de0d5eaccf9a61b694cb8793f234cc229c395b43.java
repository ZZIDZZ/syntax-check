boolean unempty(Arc a) {
        State from = a.from;
        State to = a.to;
        boolean usefrom;        /* work on from, as opposed to to? */

        assert a.type == Compiler.EMPTY;
        assert from != pre && to != post;

        if (from == to) {       /* vacuous loop */
            freearc(a);
            return true;
        }

    /* decide which end to work on */
        usefrom = true;         /* default:  attack from */
        if (from.nouts > to.nins) {
            usefrom = false;
        } else if (from.nouts == to.nins) {
        /* decide on secondary issue:  move/copy fewest arcs */
            if (from.nins > to.nouts) {
                usefrom = false;
            }
        }

        freearc(a);
        if (usefrom) {
            if (from.nouts == 0) {
            /* was the state's only outarc */
                moveins(from, to);
                freestate(from);
            } else {
                copyins(from, to);
            }
        } else {
            if (to.nins == 0) {
            /* was the state's only inarc */
                moveouts(to, from);
                freestate(to);
            } else {
                copyouts(to, from);
            }
        }

        return true;
    }