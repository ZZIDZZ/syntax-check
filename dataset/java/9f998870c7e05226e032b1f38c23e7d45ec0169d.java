@Override
  protected void checkPosition () throws AbstractRootFinder.PositionUnchangedException
  {
    if (EqualsHelper.equals (m_fXMid, m_fPrevXMid))
    {
      throw new AbstractRootFinder.PositionUnchangedException ();
    }
  }