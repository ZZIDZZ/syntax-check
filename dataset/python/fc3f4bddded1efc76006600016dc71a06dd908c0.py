def main(newick):
    """Main executor of the process_newick template.

    Parameters
    ----------
    newick : str
        path to the newick file.

    """

    logger.info("Starting newick file processing")

    print(newick)

    tree = dendropy.Tree.get(file=open(newick, 'r'), schema="newick")

    tree.reroot_at_midpoint()

    to_write=tree.as_string("newick").strip().replace("[&R] ", '').replace(' ', '_').replace("'", "")

    with open(".report.json", "w") as json_report:
        json_dic = {
            "treeData": [{
                "trees": [
                    to_write
                ]
            }],
        }

        json_report.write(json.dumps(json_dic, separators=(",", ":")))

    with open(".status", "w") as status_fh:
        status_fh.write("pass")