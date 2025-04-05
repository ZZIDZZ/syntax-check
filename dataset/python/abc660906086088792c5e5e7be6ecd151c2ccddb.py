def project_home_breadcrumb_bs4(label):
    """A template tag to return the project's home URL and label
    formatted as a Bootstrap 4 breadcrumb.

    PROJECT_HOME_NAMESPACE must be defined in settings, for example:
        PROJECT_HOME_NAMESPACE = 'project_name:index_view'

    Usage Example:
        {% load project_home_tags %}

        <ol class="breadcrumb">
          {% project_home_breadcrumb_bs4 %}    {# <--- #}
          <li class="breadcrumb-item" aria-label="breadcrumb"><a href="{% url 'app:namespace' %}">List of Objects</a></li>
          <li class=" breadcrumb-item active" aria-label="breadcrumb" aria-current="page">Object Detail</li>
        </ol>

    This gets converted into:
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-label="breadcrumb"><a href="{% url 'project_name:index_view' %}">Home</a></li>    {# <--- #}
          <li class="breadcrumb-item" aria-label="breadcrumb"><a href="{% url 'app:namespace' %}">List of Objects</a></li>
          <li class=" breadcrumb-item active" aria-label="breadcrumb" aria-current="page">Object Detail</li>
        </ol>

    By default, the link's text is 'Home'. A project-wide label can be
    defined with PROJECT_HOME_LABEL in settings. Both the default and
    the project-wide label can be overridden by passing a string to
    the template tag.

    For example:
        {% project_home_breadcrumb_bs4 'Custom Label' %}
    """
    url = home_url()
    if url:
        return format_html(
            '<li class="breadcrumb-item" aria-label="breadcrumb"><a href="{}">{}</a></li>',
            url, label)
    else:
        return format_html(
            '<li class="breadcrumb-item" aria-label="breadcrumb">{}</li>',
            label)