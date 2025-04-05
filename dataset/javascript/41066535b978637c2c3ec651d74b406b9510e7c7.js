function Cart(name, duration) {
    var data, items, settings, len, i;

    this._items = [];
    this._settings = { bn: constants.BN };

    Pubsub.call(this);
    Storage.call(this, name, duration);

    if ((data = this.load())) {
        items = data.items;
        settings = data.settings;

        if (settings) {
            this._settings = settings;
        }

        if (items) {
            for (i = 0, len = items.length; i < len; i++) {
                this.add(items[i]);
            }
        }
    }
}