def save_variable_bigdl(tensors, target_path, bigdl_type="float"):
    """
    Save a variable dictionary to a Java object file, so it can be read by BigDL

    :param tensors: tensor dictionary
    :param target_path: where is the Java object file store
    :param bigdl_type: model variable numeric type
    :return: nothing
    """
    import numpy as np
    jtensors = {}
    for tn in tensors.keys():
        if not isinstance(tensors[tn], np.ndarray):
            value = np.array(tensors[tn])
        else:
            value = tensors[tn]
        jtensors[tn] = JTensor.from_ndarray(value)
        
    callBigDlFunc(bigdl_type, "saveTensorDictionary", jtensors, target_path)