private ITreeNode parseTree() {

        ITreeNode root = new TreeNodeUniqueChildren();
        ITreeNode newnode, oldnode;
        Enumeration entries = this.jar.entries();
        String entry;
        while (entries.hasMoreElements()) {
            newnode = root;
            oldnode = root;
            entry = ((JarEntry)entries.nextElement()).getName();
            System.out.println("Entry: " + entry);
            StringTokenizer tokenizer = new StringTokenizer(entry, "/");
            while (tokenizer.hasMoreElements()) {
                String path = tokenizer.nextToken();
                newnode = new TreeNodeUniqueChildren(path);
                oldnode.addChildNode(newnode);
                oldnode = newnode;
            }
        }
        return root;
    }