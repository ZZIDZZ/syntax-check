public boolean removeFooterView(View v) {
		if (mFooterViewInfos.size() > 0) {
			boolean result = false;
			if (mAdapter != null && ((FooterViewGridAdapter) mAdapter).removeFooter(v)) {
				notifiyChanged();
				result = true;
			}
			removeFixedViewInfo(v, mFooterViewInfos);
			return result;
		}
		return false;
	}