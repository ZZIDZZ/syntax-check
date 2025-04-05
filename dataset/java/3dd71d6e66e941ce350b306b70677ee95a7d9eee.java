HashMap<Serializable,BigInteger> buildCheckSumMap(Region<Serializable,Object> region)
	{
		
		if(region.getAttributes().getDataPolicy().withPartitioning())
		{
			region = PartitionRegionHelper.getLocalData(region);	
		}
		
		Set<Serializable> keySet = region.keySet();
		
		if(keySet == null || keySet.isEmpty())
			return null;
		
		HashMap<Serializable,BigInteger> regionCheckSumMap = new HashMap<Serializable,BigInteger>(keySet.size());
		Object object = null;
		
		Object tmp = null;
		for (Map.Entry<Serializable,Object> entry :region.entrySet())
		{
			object = entry.getValue();
			
			if(PdxInstance.class.isAssignableFrom(object.getClass()))
			{
				tmp = ((PdxInstance)object).getObject();
				
				if(Serializable.class.isAssignableFrom(tmp.getClass()))
				{
					object = tmp;
				}
				//else use PdxInstance.hashCode
			}

			if(!(PdxInstance.class.isAssignableFrom(object.getClass())))
			{
				regionCheckSumMap.put(entry.getKey(), MD.checksum(object));	
			}
			else
			{
				regionCheckSumMap.put(entry.getKey(),  BigInteger.valueOf(object.hashCode()));	
			}
		}
		
		return regionCheckSumMap;
	}