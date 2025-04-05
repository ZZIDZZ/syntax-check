def create_dataset(self, name, shape=None, dtype=None, data=None,
                       sparse_format=None, indptr_dtype=np.int64, indices_dtype=np.int32,
                       **kwargs):
        """Create 3 datasets in a group to represent the sparse array.

        Parameters
        ----------
        sparse_format:
        """
        if isinstance(data, Dataset):
            assert sparse_format is None
            group = self.create_group(name)
            group.attrs['h5sparse_format'] = data.attrs['h5sparse_format']
            group.attrs['h5sparse_shape'] = data.attrs['h5sparse_shape']
            group.create_dataset('data', data=data.h5py_group['data'],
                                 dtype=dtype, **kwargs)
            group.create_dataset('indices', data=data.h5py_group['indices'],
                                 dtype=indices_dtype, **kwargs)
            group.create_dataset('indptr', data=data.h5py_group['indptr'],
                                 dtype=indptr_dtype, **kwargs)
        elif ss.issparse(data):
            if sparse_format is not None:
                format_class = get_format_class(sparse_format)
                data = format_class(data)
            group = self.create_group(name)
            group.attrs['h5sparse_format'] = get_format_str(data)
            group.attrs['h5sparse_shape'] = data.shape
            group.create_dataset('data', data=data.data, dtype=dtype, **kwargs)
            group.create_dataset('indices', data=data.indices, dtype=indices_dtype, **kwargs)
            group.create_dataset('indptr', data=data.indptr, dtype=indptr_dtype, **kwargs)
        elif data is None and sparse_format is not None:
            format_class = get_format_class(sparse_format)
            if dtype is None:
                dtype = np.float64
            if shape is None:
                shape = (0, 0)
            data = format_class(shape, dtype=dtype)
            group = self.create_group(name)
            group.attrs['h5sparse_format'] = get_format_str(data)
            group.attrs['h5sparse_shape'] = data.shape
            group.create_dataset('data', data=data.data, dtype=dtype, **kwargs)
            group.create_dataset('indices', data=data.indices, dtype=indices_dtype, **kwargs)
            group.create_dataset('indptr', data=data.indptr, dtype=indptr_dtype, **kwargs)
        else:
            # forward the arguments to h5py
            assert sparse_format is None
            return super(Group, self).create_dataset(
                name, data=data, shape=shape, dtype=dtype, **kwargs)
        return Dataset(group)