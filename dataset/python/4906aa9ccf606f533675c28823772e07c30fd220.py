def OMTuple(self, l):
        """
        Convert a tuple of OM objects into an OM object

        EXAMPLES::

            >>> from openmath import openmath as om
            >>> from openmath.convert_pickle  import PickleConverter
            >>> converter = PickleConverter()
            >>> o = converter.OMTuple([om.OMInteger(2), om.OMInteger(3)]); o
            OMApplication(elem=OMSymbol(name='tuple', cd='Python', id=None, cdbase='http://python.org/'),
                     arguments=[OMInteger(integer=2, id=None), OMInteger(integer=3, id=None)], id=None, cdbase=None)
            >>> converter.to_python(o)
            (2, 3)
        """
        return om.OMApplication(elem=self.OMSymbol(module='Python', name='tuple'),
                                arguments=l)