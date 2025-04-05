def chimera_block_quotient(G, blocks):
    """
    Extract the blocks from a graph, and returns a
    block-quotient graph according to the acceptability
    functions block_good and eblock_good

    Inputs:
        G: a networkx graph
        blocks: a tuple of tuples

    """
    from networkx import Graph
    from itertools import product

    BG = Graph()
    blockid = {}
    for i, b in enumerate(blocks):
        BG.add_node(i)
        if not b or not all(G.has_node(x) for x in b):
            continue
        for q in b:
            if q in blockid:
                raise(RuntimeError, "two blocks overlap")
            blockid[q] = i

    for q, u in blockid.items():
        ublock = blocks[u]
        for p in G[q]:
            if p not in blockid:
                continue
            v = blockid[p]
            if BG.has_edge(u, v) or u == v:
                continue
            vblock = blocks[v]

            if ublock[0][2] == vblock[0][2]:
                block_edges = zip(ublock, vblock)
            else:
                block_edges = product(ublock, vblock)

            if all(G.has_edge(x, y) for x, y in block_edges):
                BG.add_edge(u, v)

    return BG