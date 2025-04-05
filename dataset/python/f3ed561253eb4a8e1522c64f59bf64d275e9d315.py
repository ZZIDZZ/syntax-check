def valid(self, token):
        """is this token valid?"""
        now = time.time()

        if 'Bearer ' in token:
            token = token[7:]

        data = None
        for secret in self.secrets:
            try:
                data = jwt.decode(token, secret)
                break
            except jwt.DecodeError:
                continue
            except jwt.ExpiredSignatureError:
                raise JwtFailed("Jwt expired")

        if not data:
            raise JwtFailed("Jwt cannot be decoded")

        exp = data.get('exp')
        if not exp:
            raise JwtFailed("Jwt missing expiration (exp)")

        if now - exp > self.age:
            raise JwtFailed("Jwt bad expiration - greater than I want to accept")

        jti = data.get('jti')
        if not jti:
            raise JwtFailed("Jwt missing one-time id (jti)")

        if self.already_used(jti):
            raise JwtFailed("Jwt re-use disallowed (jti={})".format(jti))

        return data