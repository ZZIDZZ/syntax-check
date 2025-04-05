public final static String getPkgName(JarEntry entry){
		if(entry==null){
			return "";
		}
		String s = entry.getName();
		if(s==null){
			return "";
		}
		if(s.length()==0){
			return s;
		}
		if(s.startsWith("/")){
			s = s.substring(1, s.length());
		}
		if(s.endsWith("/")){
			s = s.substring(0, s.length()-1);
		}
		return s.replace('/', '.');
	}