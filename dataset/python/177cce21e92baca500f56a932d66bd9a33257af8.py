def measure_dimension(fbasename=None, log=None, axis1=None, offset1=0.0,
                      axis2=None, offset2=0.0, ml_version=ml_version):
    """Measure a dimension of a mesh"""
    axis1 = axis1.lower()
    axis2 = axis2.lower()
    ml_script1_file = 'TEMP3D_measure_dimension.mlx'
    file_out = 'TEMP3D_measure_dimension.xyz'

    ml_script1 = mlx.FilterScript(file_in=fbasename, file_out=file_out, ml_version=ml_version)
    compute.section(ml_script1, axis1, offset1, surface=True)
    compute.section(ml_script1, axis2, offset2, surface=False)
    layers.delete_lower(ml_script1)
    ml_script1.save_to_file(ml_script1_file)
    ml_script1.run_script(log=log, script_file=ml_script1_file)

    for val in ('x', 'y', 'z'):
        if val not in (axis1, axis2):
            axis = val
    # ord: Get number that represents letter in ASCII
    # Here we find the offset from 'x' to determine the list reference
    # i.e. 0 for x, 1 for y, 2 for z
    axis_num = ord(axis) - ord('x')
    aabb = measure_aabb(file_out, log)
    dimension = {'min': aabb['min'][axis_num], 'max': aabb['max'][axis_num],
                 'length': aabb['size'][axis_num], 'axis': axis}
    if log is None:
        print('\nFor file "%s"' % fbasename)
        print('Dimension parallel to %s with %s=%s & %s=%s:' % (axis, axis1, offset1,
                                                                axis2, offset2))
        print('  Min = %s, Max = %s, Total length = %s' % (dimension['min'],
                                                           dimension['max'], dimension['length']))
    else:
        log_file = open(log, 'a')
        log_file.write('\nFor file "%s"\n' % fbasename)
        log_file.write('Dimension parallel to %s with %s=%s & %s=%s:\n' % (axis, axis1, offset1,
                                                                           axis2, offset2))
        log_file.write('min = %s\n' % dimension['min'])
        log_file.write('max = %s\n' % dimension['max'])
        log_file.write('Total length = %s\n' % dimension['length'])
        log_file.close()
    return dimension