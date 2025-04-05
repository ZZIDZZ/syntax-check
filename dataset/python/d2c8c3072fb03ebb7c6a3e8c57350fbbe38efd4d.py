def _check_struct_compatibility(self, hits):
        ''' Takes the hit array and checks if the important data fields have the same data type than the hit clustered array and that the field names are correct.'''
        for key, _ in self._cluster_hits_descr:
            if key in self._hit_fields_mapping_inverse:
                mapped_key = self._hit_fields_mapping_inverse[key]
            else:
                mapped_key = key
            # Only check hit fields that contain hit information
            if mapped_key in ['cluster_ID', 'is_seed', 'cluster_size', 'n_cluster']:
                continue
            if key not in hits.dtype.names:
                raise TypeError('Required hit field "%s" not found.' % key)
            if self._cluster_hits.dtype[mapped_key] != hits.dtype[key]:
                raise TypeError('The dtype for hit data field "%s" does not match. Got/expected: %s/%s.' % (key, hits.dtype[key], self._cluster_hits.dtype[mapped_key]))
        additional_hit_fields = set(hits.dtype.names) - set([key for key, val in self._cluster_hits_descr])
        if additional_hit_fields:
            logging.warning('Found additional hit fields: %s' % ", ".join(additional_hit_fields))