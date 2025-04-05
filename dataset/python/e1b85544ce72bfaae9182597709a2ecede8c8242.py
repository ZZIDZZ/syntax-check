async def _handle_metrics(self, request: Request) -> Response:
        """Handler for metrics."""
        if self._update_handler:
            await self._update_handler(self.registry.get_metrics())
        response = Response(body=self.registry.generate_metrics())
        response.content_type = CONTENT_TYPE_LATEST
        return response