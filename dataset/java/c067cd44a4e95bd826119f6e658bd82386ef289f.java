public static Point3D_F64 mean( List<Point3D_F64> points , int num , Point3D_F64 mean ) {
		if( mean == null )
			mean = new Point3D_F64();

		double x = 0, y = 0, z = 0;

		for( int i = 0; i < num; i++ ) {
			Point3D_F64 p = points.get(i);
			x += p.x;
			y += p.y;
			z += p.z;
		}

		mean.x = x / num;
		mean.y = y / num;
		mean.z = z / num;

		return mean;
	}