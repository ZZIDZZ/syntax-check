@Override
	public boolean getAllowRobots(ServletContext servletContext, HttpServletRequest request, HttpServletResponse response, Page page) throws ServletException, IOException {
		return PageUtils.findAllowRobots(servletContext, request, response, page);
	}