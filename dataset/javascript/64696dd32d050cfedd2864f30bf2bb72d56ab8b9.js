function getBaseConfig(isProd) {
  // get library details from JSON config
  const libraryEntryPoint = path.join('src', LIBRARY_DESC.entry);

  // generate webpack base config
  return {
    entry: [
      // "babel-polyfill",
      path.join(__dirname, libraryEntryPoint),
    ],
    output: {
      devtoolLineToLine: true,
      pathinfo: true,
    },
    module: {
      preLoaders: [
        {
          test: /\.js$/,
          exclude: /(node_modules|bower_components)/,
          loader: "eslint-loader",
        },
      ],
      loaders: [
        {
          exclude: /(node_modules|bower_components)/,
          loader: "babel-loader",
          plugins: [
            "transform-runtime",
          ],
          query: {
            presets: [
              "es2015",
              "stage-0",
              "stage-1",
              "stage-2",
            ],
            cacheDirectory: false,
          },
          test: /\.js$/,
        },
      ],
    },
    eslint: {
      configFile: './.eslintrc',
    },
    resolve: {
      root: path.resolve('./src'),
      extensions: ['', '.js'],
    },
    devtool: isProd ? "source-map"/* null*/ : "source-map"/* '#eval-source-map'*/,
    debug: !isProd,
    plugins: isProd ? [
      new webpack.DefinePlugin({ 'process.env': { NODE_ENV: '"production"' } }),
      new UglifyJsPlugin({
        compress: { warnings: true },
        minimize: true,
        sourceMap: true,
      }),
      // Prod plugins here
    ] : [
      new webpack.DefinePlugin({ 'process.env': { NODE_ENV: '"development"' } }),
      new UglifyJsPlugin({
        compress: { warnings: true },
        minimize: true,
        sourceMap: true,
      }),
      // Dev plugins here
    ],
  };
}