def html_tags(self, *args, **kwargs):
        """Return all html tags for all asset_type
        """
        html = []
        for asset_type in list_asset_types():
            html.append(self.html_tags_for(asset_type.name, *args, **kwargs))
        return "\n".join(html)