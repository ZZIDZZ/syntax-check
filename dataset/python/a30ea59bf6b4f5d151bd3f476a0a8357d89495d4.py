def find_attacker_slider(dest_list, occ_bb, piece_bb, target_bb, pos,
                             domain):
    """ Find a slider attacker

    Parameters
    ----------
    dest_list : list
        To store the results.
    occ_bb : int, bitboard
        Occupancy bitboard.
    piece_bb : int, bitboard
        Bitboard with the position of the attacker piece.
    target_bb : int, bitboard
        Occupancy bitboard without any of the sliders in question.
    pos : int
        Target position.
    pos_map : function
        Mapping between a board position and its position in a single
        rotated/translated rank produced with domain_trans.
    domain_trans : function
        Transformation from a rank/file/diagonal/anti-diagonal containing pos
        to a single rank
    pos_inv_map : function
        Inverse of pos_map
    """
    pos_map, domain_trans, pos_inv_map = domain
    r = reach[pos_map(pos)][domain_trans(target_bb, pos)]
    m = r & domain_trans(piece_bb, pos)
    while m:
        r = m&-m
        rpos = r.bit_length()-1
        if not (ray[rpos][pos_map(pos)] & domain_trans(occ_bb, pos)):
            dest_list.append(pos_inv_map(rpos, pos))
        m ^= r