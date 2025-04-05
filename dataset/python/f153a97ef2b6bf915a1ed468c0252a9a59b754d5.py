def get_subnode(self, dst, ast, expr):
    """
        get the value of subnode

        example::

            R = [
                __scope__:big  getsomethingbig:>big
                #get(_, big, '.val') // copy big.val into _
            ]
    """
    dst.value = eval('ast' + expr)
    return True