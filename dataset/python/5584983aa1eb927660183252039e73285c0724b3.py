def tdms2fcs(tdms_file):
    """Creates an fcs file for a given tdms file"""
    fcs_file = tdms_file[:-4]+"fcs"
    chn_names, data = read_tdms(tdms_file)
    chn_names, data = add_deformation(chn_names, data)
    fcswrite.write_fcs(filename=fcs_file,
                       chn_names=chn_names,
                       data=np.array(data).transpose())