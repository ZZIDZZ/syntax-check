def update_site_forward(apps, schema_editor):
    """Set site domain and name."""
    Site = apps.get_model("sites", "Site")
    Site.objects.update_or_create(
        id=settings.SITE_ID,
        defaults={
            "domain": "{{cookiecutter.domain_name}}",
            "name": "{{cookiecutter.project_name}}",
        },
    )