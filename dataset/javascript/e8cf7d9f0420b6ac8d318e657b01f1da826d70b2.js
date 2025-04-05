function main() {
    return __awaiter(this, void 0, void 0, function () {
        var outputDataSize, interval, dataFrame, dateFormat, api;
        return __generator(this, function (_a) {
            switch (_a.label) {
                case 0:
                    outputDataSize = "compact";
                    if (argv.outputDataSize) {
                        outputDataSize = argv.outputDataSize;
                    }
                    interval = '60min';
                    if (argv.interval) {
                        interval = argv.interval;
                    }
                    api = new index_1.AlphaVantageAPI(argv.apiKey, outputDataSize, argv.verbose);
                    if (!(argv.type === 'daily')) return [3 /*break*/, 2];
                    return [4 /*yield*/, api.getDailyDataFrame(argv.symbol)];
                case 1:
                    dataFrame = _a.sent();
                    dateFormat = 'YYYY-MM-DD';
                    return [3 /*break*/, 5];
                case 2:
                    if (!(argv.type === 'intraday')) return [3 /*break*/, 4];
                    return [4 /*yield*/, api.getIntradayDataFrame(argv.symbol, interval)];
                case 3:
                    dataFrame = _a.sent();
                    dateFormat = "YYYY-MM-DD HH:mm:ss";
                    return [3 /*break*/, 5];
                case 4: throw new Error("Unexpected data type: " + argv.type + ", expected it to be either 'daily' or 'intrday'");
                case 5:
                    if (!argv.verbose) {
                        console.log('>> ' + argv.out);
                    }
                    dataFrame
                        .transformSeries({
                        Timestamp: function (t) { return moment(t).format(dateFormat); },
                    })
                        .asCSV()
                        .writeFileSync(argv.out);
                    return [2 /*return*/];
            }
        });
    });
}