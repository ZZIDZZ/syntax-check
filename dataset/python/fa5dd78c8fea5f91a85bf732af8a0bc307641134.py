def to_dates(param):
    """
    This function takes a date string in various formats
    and converts it to a normalized and validated date range. A list
    with two elements is returned, lower and upper date boundary.

    Valid inputs are, for example:
    2012              => Jan 1 20012 - Dec 31 2012 (whole year)
    201201            => Jan 1 2012  - Jan 31 2012 (whole month)
    2012101           => Jan 1 2012 - Jan 1 2012   (whole day)
    2011-2011         => same as "2011", which means whole year 2012
    2011-2012         => Jan 1 2011 - Dec 31 2012  (two years)
    201104-2012       => Apr 1 2011 - Dec 31 2012
    201104-201203     => Apr 1 2011 - March 31 2012
    20110408-2011     => Apr 8 2011 - Dec 31 2011
    20110408-201105   => Apr 8 2011 - May 31 2011
    20110408-20110507 => Apr 8 2011 - May 07 2011
    2011-             => Jan 1 2012 - Dec 31 9999 (unlimited)
    201104-           => Apr 1 2011 - Dec 31 9999 (unlimited)
    20110408-         => Apr 8 2011 - Dec 31 9999 (unlimited)
    -2011             Jan 1 0000 - Dez 31 2011
    -201104           Jan 1 0000 - Apr 30, 2011
    -20110408         Jan 1 0000 - Apr 8, 2011
    """
    pos = param.find('-')
    lower, upper = (None, None)
    if pos == -1:
        # no seperator given
        lower, upper = (param, param)
    else:
        lower, upper = param.split('-')
    ret = (expand_date_param(lower, 'lower'), expand_date_param(upper, 'upper'))
    return ret