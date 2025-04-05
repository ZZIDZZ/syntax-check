def highlight_info(ctx, style):
    """Outputs the CSS which can be customized for highlighted code"""
    click.secho("The following styles are available to choose from:", fg="green")
    click.echo(list(pygments.styles.get_all_styles()))
    click.echo()
    click.secho(
        f'The following CSS for the "{style}" style can be customized:', fg="green"
    )
    click.echo(pygments.formatters.HtmlFormatter(style=style).get_style_defs())