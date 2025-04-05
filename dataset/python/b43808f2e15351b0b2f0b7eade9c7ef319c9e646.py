def tex2pdf(tex_file, output_file=None, output_format='pdf'):
    """ Call PDFLatex to convert TeX files to PDF.

    Parameters
    ----------
    tex_file: str
        Path to the input LateX file.

    output_file: str
        Path to the output PDF file.
        If None, will use the same output directory as the tex_file.

    output_format: str
        Output file format. Choices: 'pdf' or 'dvi'. Default: 'pdf'

    Returns
    -------
    return_value
        PDFLatex command call return value.
    """
    if not os.path.exists(tex_file):
        raise IOError('Could not find file {}.'.format(tex_file))

    if output_format != 'pdf' and output_format != 'dvi':
        raise ValueError("Invalid output format given {}. Can only accept 'pdf' or 'dvi'.".format(output_format))

    cmd_name = 'pdflatex'
    check_command(cmd_name)

    args_strings = [cmd_name]
    if output_file is not None:
        args_strings += ['-output-directory="{}" '.format(os.path.abspath(os.path.dirname(output_file)))]

    result_dir = os.path.dirname(output_file) if output_file else os.path.dirname(tex_file)

    args_strings += ['-output-format="{}"'.format(output_format)]
    args_strings += ['"' + tex_file + '"']

    log.debug('Calling command {} with args: {}.'.format(cmd_name, args_strings))
    ret = simple_call(args_strings)

    result_file = os.path.join(result_dir, remove_ext(os.path.basename(tex_file)) + '.' + output_format)
    if os.path.exists(result_file):
        shutil.move(result_file, output_file)
    else:
        raise IOError('Could not find PDFLatex result file.')

    log.debug('Cleaning *.aux and *.log files from folder {}.'.format(result_dir))
    cleanup(result_dir, 'aux')
    cleanup(result_dir, 'log')

    return ret