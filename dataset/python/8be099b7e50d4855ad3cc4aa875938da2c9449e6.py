def get_internal_energy(ampal_obj, ff=None, assign_ff=True):
    """Calculates the internal energy of the AMPAL object.

    Parameters
    ----------
    ampal_obj: AMPAL Object
        Any AMPAL object with a `get_atoms` method.
    ff: BuffForceField, optional
        The force field to be used for scoring. If no force field is
        provided then the most current version of the BUDE force field
        will be used.
    assign_ff: bool, optional
        If true, then force field assignment on the AMPAL object will be
        will be updated.

    Returns
    -------
    BUFF_score: BUFFScore
        A BUFFScore object with information about each of the interactions and
        the atoms involved.
    """
    if ff is None:
        ff = FORCE_FIELDS['bude_2016v1']
    if assign_ff:
        assign_force_field(ampal_obj, ff)
    interactions = find_intra_ampal(ampal_obj, ff.distance_cutoff)
    buff_score = score_interactions(interactions, ff)
    return buff_score