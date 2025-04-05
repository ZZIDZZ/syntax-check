public void setItems(List<V> items) {
		final List<V> its = items == null ? ImmutableList.of() : items;
		this.items = its;
		getComboBoxCellEditor().setInput(items);
	}