public DseCluster getCluster(String hostsAndPorts, String username, String password,
            String authorizationId) {
        return getCluster(
                ClusterIdentifier.getInstance(hostsAndPorts, username, password, authorizationId));
    }