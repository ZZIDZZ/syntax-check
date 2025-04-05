@Override
    public void exceptionCaught(ChannelHandlerContext ctx, ExceptionEvent e)
            throws Exception {
        cancelDirectConnectionTimer ( );
		Logger.getLogger(PortUnificationHandler.class.getName()).severe("Exception on connection to " + ctx.getChannel().getRemoteAddress() + ": " + e.getCause().getMessage() );
    }