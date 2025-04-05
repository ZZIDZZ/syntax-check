protected String checkPath(String path){
        if (path.toLowerCase().contains("statements") && path.toLowerCase().contains("more")){
            int pathLength = this._host.getPath().length();
            return path.substring(pathLength, path.length());
        }
        return path;
    }