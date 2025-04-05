def sort_enum_for_model(cls, name=None, symbol_name=_symbol_name):
    """Create Graphene Enum for sorting a SQLAlchemy class query

    Parameters
    - cls : Sqlalchemy model class
        Model used to create the sort enumerator
    - name : str, optional, default None
        Name to use for the enumerator. If not provided it will be set to `cls.__name__ + 'SortEnum'`
    - symbol_name : function, optional, default `_symbol_name`
        Function which takes the column name and a boolean indicating if the sort direction is ascending,
        and returns the symbol name for the current column and sort direction.
        The default function will create, for a column named 'foo', the symbols 'foo_asc' and 'foo_desc'

    Returns
    - Enum
        The Graphene enumerator
    """
    enum, _ = _sort_enum_for_model(cls, name, symbol_name)
    return enum