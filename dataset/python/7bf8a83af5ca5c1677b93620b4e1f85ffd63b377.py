def multi_rouge_n(sequences, scores_ids, n=2):
    """
    Efficient way to compute highly repetitive scoring
    i.e. sequences are involved multiple time

    Args:
        sequences(list[str]): list of sequences (either hyp or ref)
        scores_ids(list[tuple(int)]): list of pairs (hyp_id, ref_id)
            ie. scores[i] = rouge_n(scores_ids[i][0],
                                    scores_ids[i][1])

    Returns:
        scores: list of length `len(scores_ids)` containing rouge `n`
                scores as a dict with 'f', 'r', 'p'
    Raises:
        KeyError: if there's a value of i in scores_ids that is not in
                  [0, len(sequences)[
    """
    ngrams = [_get_word_ngrams(n, sequence) for sequence in sequences]
    counts = [len(ngram) for ngram in ngrams]

    scores = []
    for hyp_id, ref_id in scores_ids:
        evaluated_ngrams = ngrams[hyp_id]
        evaluated_count = counts[hyp_id]

        reference_ngrams = ngrams[ref_id]
        reference_count = counts[ref_id]

        overlapping_ngrams = evaluated_ngrams.intersection(reference_ngrams)
        overlapping_count = len(overlapping_ngrams)

        scores += [f_r_p_rouge_n(evaluated_count,
                                 reference_count, overlapping_count)]
    return scores