def chrono(ctx, app_id, sentence_file,
           json_flag, sentence, doc_time, request_id):
    # type: (Context, unicode, Optional[IO], bool, unicode, unicode, unicode) -> None  # NOQA
    """Extract expression expressing date and time and normalize its value """

    app_id = clean_app_id(app_id)
    sentence = clean_sentence(sentence, sentence_file)

    api = GoolabsAPI(app_id)
    ret = api.chrono(
        sentence=sentence,
        doc_time=doc_time,
        request_id=request_id,
    )

    if json_flag:
        click.echo(format_json(api.response.json()))
        return

    for pair in ret['datetime_list']:
        click.echo(u'{0}: {1}'.format(text(pair[0]), pair[1]))