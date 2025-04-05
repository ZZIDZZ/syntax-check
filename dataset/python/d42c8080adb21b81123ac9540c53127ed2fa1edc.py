def write_json(f: TextIO, deja_vu_sans_path: str,
               measurer: text_measurer.TextMeasurer,
               encodings: Iterable[str]) -> None:
    """Write the data required by PrecalculatedTextMeasurer to a stream."""
    supported_characters = list(
        generate_supported_characters(deja_vu_sans_path))
    kerning_characters = ''.join(
        generate_encodeable_characters(supported_characters, encodings))
    char_to_length = calculate_character_to_length_mapping(measurer,
                                                           supported_characters)
    pair_to_kerning = calculate_pair_to_kern_mapping(measurer, char_to_length,
                                                     kerning_characters)
    json.dump(
        {'mean-character-length': statistics.mean(char_to_length.values()),
         'character-lengths': char_to_length,
         'kerning-characters': kerning_characters,
         'kerning-pairs': pair_to_kerning},
        f, sort_keys=True, indent=1)