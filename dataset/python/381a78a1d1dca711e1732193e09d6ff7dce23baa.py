def _add_ones_dim(arr):
    "Adds a dimensions with ones to array."
    arr = arr[..., np.newaxis]
    return np.concatenate((arr, np.ones_like(arr)), axis=-1)