def complex_input_with_reference():
    """
    use ComplexDataInput with a reference to a document
    """
    
    print("\ncomplex_input_with_reference ...")

    wps = WebProcessingService('http://localhost:8094/wps', verbose=verbose)

    processid = 'wordcount'
    textdoc = ComplexDataInput("http://www.gutenberg.org/files/28885/28885-h/28885-h.htm")   # alice in wonderland
    inputs = [("text", textdoc)]
    # list of tuple (output identifier, asReference attribute, mimeType attribute)
    # when asReference or mimeType is None - the wps service will use its default option
    outputs = [("output",True,'some/mime-type')]

    execution = wps.execute(processid, inputs, output=outputs)
    monitorExecution(execution)

    # show status
    print('percent complete', execution.percentCompleted)
    print('status message', execution.statusMessage)

    for output in execution.processOutputs:
        print('identifier=%s, dataType=%s, data=%s, reference=%s' % (output.identifier, output.dataType, output.data, output.reference))