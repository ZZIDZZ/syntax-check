def assert_unit_convertability(name, value, target_unit, unit_framework):
    """
    Check that a value has physical type consistent with user-specified units

    Note that this does not convert the value, only check that the units have
    the right physical dimensionality.

    Parameters
    ----------
    name : str
        The name of the value to check (used for error messages).
    value : `numpy.ndarray` or instance of `numpy.ndarray` subclass
        The value to check.
    target_unit : unit
        The unit that the value should be convertible to.
    unit_framework : str
        The unit framework to use
    """

    if unit_framework == ASTROPY:

        from astropy.units import Quantity

        if not isinstance(value, Quantity):
            raise TraitError("{0} should be given as an Astropy Quantity instance".format(name))

        if not target_unit.is_equivalent(value.unit):
            raise TraitError("{0} should be in units convertible to {1}".format(name, target_unit))

    elif unit_framework == PINT:

        from pint.unit import UnitsContainer

        if not (hasattr(value, 'dimensionality') and isinstance(value.dimensionality, UnitsContainer)):
            raise TraitError("{0} should be given as a Pint Quantity instance".format(name))

        if value.dimensionality != target_unit.dimensionality:
            raise TraitError("{0} should be in units convertible to {1}".format(name, target_unit))

    elif unit_framework == QUANTITIES:

        from quantities import Quantity

        if not isinstance(value, Quantity):
            raise TraitError("{0} should be given as a quantities Quantity instance".format(name))

        if value.dimensionality.simplified != target_unit.dimensionality.simplified:
            raise TraitError("{0} should be in units convertible to {1}".format(name, target_unit.dimensionality.string))