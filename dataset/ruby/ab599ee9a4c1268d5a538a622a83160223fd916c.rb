def confirm_ejson_keys_not_prunable
      secret = ejson_provisioner.ejson_keys_secret
      return unless secret.dig("metadata", "annotations", KubernetesResource::LAST_APPLIED_ANNOTATION)

      @logger.error("Deploy cannot proceed because protected resource " \
        "Secret/#{EjsonSecretProvisioner::EJSON_KEYS_SECRET} would be pruned.")
      raise EjsonPrunableError
    rescue Kubectl::ResourceNotFoundError => e
      @logger.debug("Secret/#{EjsonSecretProvisioner::EJSON_KEYS_SECRET} does not exist: #{e}")
    end