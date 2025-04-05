def index():
    """List pending access requests and shared links."""
    query = request.args.get('query', '')
    order = request.args.get('sort', '-created')
    try:
        page = int(request.args.get('page', 1))
        per_page = int(request.args.get('per_page', 20))
    except (TypeError, ValueError):
        abort(404)

    # Delete form
    form = DeleteForm(request.form)
    if form.validate_on_submit():
        link = SecretLink.query_by_owner(current_user).filter_by(
            id=form.link.data).first()
        if link.revoke():
            flash(_("Shared link revoked."), category='success')
        db.session.commit()

    # Links
    links = SecretLink.query_by_owner(current_user).filter(
        SecretLink.revoked_at.is_(None)
    )

    # Querying
    if query:
        lquery = "%{0}%".format(query)
        links = links.filter(
            SecretLink.title.like(lquery) | SecretLink.description.like(lquery)
        )

    # Ordering
    ordering = QueryOrdering(links, ['title', 'created', 'expires_at'], order)
    links = ordering.items()

    # Pending access requests
    requests = AccessRequest.query_by_receiver(current_user).filter_by(
        status=RequestStatus.PENDING).order_by('created')

    return render_template(
        "zenodo_accessrequests/settings/index.html",
        links_pagination=links.paginate(page, per_page=per_page),
        requests=requests,
        query=query,
        order=ordering,
        get_record=get_record,
        form=DeleteForm(),
    )