function Seven(_a) {
                    var _b = _a === void 0 ? {} : _a, height = _b.height, width = _b.width, _c = _b.angle, angle = _c === void 0 ? 10 : _c, _d = _b.ratioLtoW, ratioLtoW = _d === void 0 ? 4 : _d, _e = _b.ratioLtoS, ratioLtoS = _e === void 0 ? 32 : _e, _f = _b.digit, digit = _f === void 0 ? Digit.BLANK : _f;
                    /** The cononical points for a horizontal segment for the given configuration. */
                    this._horizontalSegmentGeometry = [
                        { x: 0, y: 0 },
                        { x: 0, y: 0 },
                        { x: 0, y: 0 },
                        { x: 0, y: 0 },
                        { x: 0, y: 0 },
                        { x: 0, y: 0 }
                    ];
                    /** The cononical points for a vertical segment for the given configuration. */
                    this._verticalSegmentGeometry = [
                        { x: 0, y: 0 },
                        { x: 0, y: 0 },
                        { x: 0, y: 0 },
                        { x: 0, y: 0 },
                        { x: 0, y: 0 },
                        { x: 0, y: 0 }
                    ];
                    /** The x and y shifts that must be applied to each segment. */
                    this._translations = [
                        { x: 0, y: 0, a: this._horizontalSegmentGeometry },
                        { x: 0, y: 0, a: this._verticalSegmentGeometry },
                        { x: 0, y: 0, a: this._verticalSegmentGeometry },
                        { x: 0, y: 0, a: this._horizontalSegmentGeometry },
                        { x: 0, y: 0, a: this._verticalSegmentGeometry },
                        { x: 0, y: 0, a: this._verticalSegmentGeometry },
                        { x: 0, y: 0, a: this._horizontalSegmentGeometry }
                    ];
                    /** The segments, A-G of the digit. */
                    this.segments = [new Segment(), new Segment(), new Segment(), new Segment(), new Segment(), new Segment(), new Segment()];
                    this._angleDegree = angle;
                    this.digit = digit;
                    this._ratioLtoW = ratioLtoW;
                    this._ratioLtoS = ratioLtoS;
                    this._height = this._width = 100; //initialize so checkConfig passes, and for default case
                    this._isHeightFixed = true;
                    if (height !== undefined) {
                        this._height = height;
                    }
                    else if (width !== undefined) {
                        this._width = width;
                        this._isHeightFixed = false;
                    } //else - neither specified, default to height=100
                    this._positionSegments();
                }