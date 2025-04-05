public Collection<ServiceInstance<T>> queryForInstances(String name) throws Exception {
        List<ServiceInstance<T>> serviceInstances = new ArrayList<ServiceInstance<T>>();
        Iterator<Service> services = client.getServicesClient().list(new MethodOptions(100, null));
        while (services.hasNext()) {
            Service service = services.next();
            if (service.getTags().contains(typeTag) && service.getMetadata().get(ServiceTracker.NAME).equals(name)) {
                // does the job of the serializer in the curator code (theirs is just a json marshaller anyway).
                serviceInstances.add(convert(service));
            }
        }
        return serviceInstances;
    }