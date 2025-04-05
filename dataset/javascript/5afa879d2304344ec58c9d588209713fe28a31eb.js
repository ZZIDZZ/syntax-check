function compileSass(_path, ext, data, callback) {
  const compiledCss = sass.renderSync({
    data: data,
    outputStyle: 'expanded',
    importer: function (url, prev, done) {
      if (url.startsWith('~')) {
        const newUrl = path.join(__dirname, 'node_modules', url.substr(1));
        return { file: newUrl };
      } else {
        return { file: url };
      }
    }
  });
  callback(null, compiledCss.css);
}