def loud(self, lang='englist'):
        """Speak loudly! FIVE! Use upper case!"""
        lang_method = getattr(self, lang, None)
        if lang_method:
            return lang_method().upper()
        else:
            return self.english().upper()