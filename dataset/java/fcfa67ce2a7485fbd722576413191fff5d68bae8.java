private void calculateRows()
    {
        //create the sorted list of points
        GridPoint points[] = new GridPoint[areas.size() * 2];
        int pi = 0;
        for (Area area : areas)
        {
            points[pi] = new GridPoint(area.getY1(), area, true);
            points[pi+1] = new GridPoint(area.getY2() + 1, area, false);
            pi += 2;
            //Y2+1 ensures that the end of one box will be on the same point
            //as the start of the following box
        }
        Arrays.sort(points);
        
        //calculate the number of rows
        int cnt = 0;
        int last = abspos.getY1();
        for (int i = 0; i < points.length; i++)
            if (!theSame(points[i].value, last))
            { 
                last = points[i].value;
                cnt++;
            }
        if (!theSame(last, abspos.getY2()))
        	cnt++; //last row finishes the whole area
        height = cnt;
        
        //calculate the row heights and the layout
        rows = new int[height];
        cnt = 0;
        last = abspos.getY1();
        for (int i = 0; i < points.length; i++)
        {
            if (!theSame(points[i].value, last)) 
            {
                rows[cnt] = points[i].value - last;
                last = points[i].value;
                cnt++;
            }
            if (points[i].begin)
            {
                target.getPosition(points[i].area).setY1(cnt);
                //points[i].node.getArea().setY1(parent.getArea().getY1() + getRowOfs(cnt));
            }
            else
            {
                Rectangular pos = target.getPosition(points[i].area); 
                pos.setY2(cnt-1);
                if (pos.getY2() < pos.getY1())
                    pos.setY2(pos.getY1());
                //points[i].node.getArea().setY2(parent.getArea().getY1() + getRowOfs(pos.getY2()+1));
            }
        }
        if (!theSame(last, abspos.getY2()))
        	rows[cnt] = abspos.getY2() - last;
    }