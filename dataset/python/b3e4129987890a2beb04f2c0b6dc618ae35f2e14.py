def unordered_storage(config, name=None):
    '''Return an unordered storage system based on the specified config.

    The canonical example of such a storage container is
    ``defaultdict(set)``. Thus, the return value of this method contains
    keys and values. The values are unordered sets.

    Args:
        config (dict): Defines the configurations for the storage.
            For in-memory storage, the config ``{'type': 'dict'}`` will
            suffice. For Redis storage, the type should be ``'redis'`` and
            the configurations for the Redis database should be supplied
            under the key ``'redis'``. These parameters should be in a form
            suitable for `redis.Redis`. The parameters may alternatively
            contain references to environment variables, in which case
            literal configuration values should be replaced by dicts of
            the form::

                {'env': 'REDIS_HOSTNAME',
                 'default': 'localhost'}

            For a full example, see :ref:`minhash_lsh_at_scale`

        name (bytes, optional): A reference name for this storage container.
            For dict-type containers, this is ignored. For Redis containers,
            this name is used to prefix keys pertaining to this storage
            container within the database.
    '''
    tp = config['type']
    if tp == 'dict':
        return DictSetStorage(config)
    if tp == 'redis':
        return RedisSetStorage(config, name=name)