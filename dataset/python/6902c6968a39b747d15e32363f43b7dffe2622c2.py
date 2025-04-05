def check(thing):
    """Check data in Invenio legacy."""
    init_app_context()

    try:
        thing_func = collect_things_entry_points()[thing]
    except KeyError:
        click.Abort(
            '{0} is not in the list of available things to migrate: '
            '{1}'.format(thing, collect_things_entry_points()))

    click.echo("Querying {0}...".format(thing))
    count, items = thing_func.get_check()

    i = 0
    click.echo("Checking {0}...".format(thing))
    with click.progressbar(length=count) as bar:
        for _id in items:
            thing_func.check(_id)
            i += 1
            bar.update(i)