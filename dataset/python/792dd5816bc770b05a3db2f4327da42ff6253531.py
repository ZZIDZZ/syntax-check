def save(hdf5_filename, array):
    """
    Export a numpy array to a HDF5 file.

    Arguments:
        hdf5_filename (str): A filename to which to save the HDF5 data
        array (numpy.ndarray): The numpy array to save to HDF5

    Returns:
        String. The expanded filename that now holds the HDF5 data
    """
    # Expand filename to be absolute
    hdf5_filename = os.path.expanduser(hdf5_filename)

    try:
        h = h5py.File(hdf5_filename, "w")
        h.create_dataset('CUTOUT', data=array)
        h.close()
    except Exception as e:
        raise ValueError("Could not save HDF5 file {0}.".format(hdf5_filename))

    return hdf5_filename