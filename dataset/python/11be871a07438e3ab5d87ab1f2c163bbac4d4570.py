def retrieve(ctx, preview_id, *args, **kwargs):
    """
    Retreive preview results for ID.
    """
    file_previews = ctx.obj['file_previews']
    results = file_previews.retrieve(preview_id)

    click.echo(results)