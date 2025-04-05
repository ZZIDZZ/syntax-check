def selectPolicy(self, origin, request_method=None):
        "Based on the matching strategy and the origin and optionally the requested method a tuple of policyname and origin to pass back is returned."
        ret_origin = None
        policyname = None
        if self.matchstrategy in ("firstmatch", "verbmatch"):
            for pol in self.activepolicies:
                policy=self.policies[pol]
                ret_origin = None
                policyname = policy.name
                if policyname == "deny":
                    break
                if self.matchstrategy == "verbmatch":
                    if policy.methods != "*" and not CORS.matchlist(request_method, policy.methods, case_sensitive=True):
                        continue
                if origin and policy.match:
                    if CORS.matchlist(origin, policy.match):
                        ret_origin = origin
                elif policy.origin == "copy":
                    ret_origin = origin
                elif policy.origin:
                    ret_origin = policy.origin
                if ret_origin:
                    break
        return policyname, ret_origin