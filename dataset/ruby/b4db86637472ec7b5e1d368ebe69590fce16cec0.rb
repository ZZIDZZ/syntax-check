def get_user_stat
            response = self.get("/v1/stats/users.json?auth_token=#{@auth_token}")
            JSON.parse response.body if response and response.body
        end