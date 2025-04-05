def main():
    """Delete previous webhooks. If local ngrok tunnel, create a webhook."""
    api = WebexTeamsAPI()
    delete_webhooks_with_name(api, name=WEBHOOK_NAME)
    public_url = get_ngrok_public_url()
    if public_url is not None:
        create_ngrok_webhook(api, public_url)