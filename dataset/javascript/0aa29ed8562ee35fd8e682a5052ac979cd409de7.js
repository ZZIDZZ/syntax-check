function(id, rowIndex) {
        AppDispatcher.dispatchAction({
            actionType: this.actionTypes.TOGGLE_ROW_SELECT,
            component: 'Table',
            id: id,
            data: {
                rowIndex: rowIndex
            }
        });
    }