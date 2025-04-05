def login(request, template_name='ci/login.html',
          redirect_field_name=REDIRECT_FIELD_NAME,
          authentication_form=AuthenticationForm):
    """
    Displays the login form and handles the login action.
    """
    redirect_to = request.POST.get(redirect_field_name,
                                   request.GET.get(redirect_field_name, ''))

    if request.method == "POST":
        form = authentication_form(request, data=request.POST)
        if form.is_valid():

            # Ensure the user-originating redirection url is safe.
            if not is_safe_url(url=redirect_to, host=request.get_host()):
                redirect_to = resolve_url(settings.LOGIN_REDIRECT_URL)

            # Okay, security check complete. Get the user object from auth api.
            user = form.get_user()
            request.session['user_token'] = user["token"]
            request.session['user_email'] = user["email"]
            request.session['user_permissions'] = user["permissions"]
            request.session['user_id'] = user["id"]
            request.session['user_list'] = user["user_list"]

            if not settings.HIDE_DASHBOARDS:
                # Set user dashboards because they are slow to change
                dashboards = ciApi.get_user_dashboards(user["id"])
                dashboard_list = list(dashboards['results'])
                if len(dashboard_list) > 0:
                    request.session['user_dashboards'] = \
                        dashboard_list[0]["dashboards"]
                    request.session['user_default_dashboard'] = \
                        dashboard_list[0]["default_dashboard"]["id"]
                else:
                    request.session['user_dashboards'] = []
                    request.session['user_default_dashboard'] = None

            # Get the user access tokens too and format for easy access
            tokens = ciApi.get_user_service_tokens(
                params={"user_id": user["id"]})
            token_list = list(tokens['results'])
            user_tokens = {}
            if len(token_list) > 0:
                for token in token_list:
                    user_tokens[token["service"]["name"]] = {
                        "token": token["token"],
                        "url": token["service"]["url"] + "/api/v1"
                    }
            request.session['user_tokens'] = user_tokens

            return HttpResponseRedirect(redirect_to)
    else:
        form = authentication_form(request)

    current_site = get_current_site(request)

    context = {
        'form': form,
        redirect_field_name: redirect_to,
        'site': current_site,
        'site_name': current_site.name,
    }

    return TemplateResponse(request, template_name, context)