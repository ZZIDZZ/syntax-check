function Drag(parent, options) {
        _classCallCheck(this, Drag);

        options = options || {};

        var _this = _possibleConstructorReturn(this, (Drag.__proto__ || Object.getPrototypeOf(Drag)).call(this, parent));

        _this.moved = false;
        _this.wheelActive = utils.defaults(options.wheel, true);
        _this.wheelScroll = options.wheelScroll || 1;
        _this.reverse = options.reverse ? 1 : -1;
        _this.clampWheel = options.clampWheel;
        _this.factor = options.factor || 1;
        _this.xDirection = !options.direction || options.direction === 'all' || options.direction === 'x';
        _this.yDirection = !options.direction || options.direction === 'all' || options.direction === 'y';
        _this.parseUnderflow(options.underflow || 'center');
        _this.mouseButtons(options.mouseButtons);
        return _this;
    }