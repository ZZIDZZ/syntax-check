def load_params(self, path, exclude_free_params=False):
        from deepy.core import graph
        """
        Load parameters to the block.
        """
        from deepy.core.comp_graph import ComputationalGraph
        model = graph.compile(blocks=[self])
        model.load_params(path, exclude_free_params=exclude_free_params)