def energy(self, state=None):
        """Calculates the length of the route."""
        state = self.state if state is None else state
        route = state
        e = 0
        if self.distance_matrix:
            for i in range(len(route)):
                e += self.distance_matrix["{},{}".format(route[i-1], route[i])]
        else:
            for i in range(len(route)):
                e += distance(self.cities[route[i-1]], self.cities[route[i]])
        return e