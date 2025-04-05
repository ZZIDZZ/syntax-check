def save_graph_only(caffe_def_path, caffemodel_path, inputs, output_file_path, output_node_names, graph_name='Graph',
                    use_padding_same=False):
    """Save a small version of the graph based on a Caffe model, the input tensors and the output node names."""
    with caffe_to_tensorflow_session(caffe_def_path, caffemodel_path, inputs, graph_name=graph_name,
                                     use_padding_same=use_padding_same) as sess:
        tf_freeze.save_graph_only(sess, output_file_path, output_node_names)