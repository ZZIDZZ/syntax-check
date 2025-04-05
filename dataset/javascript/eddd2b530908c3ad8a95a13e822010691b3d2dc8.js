function render(url) {
  return async page => {
    try {
      const template = `${page.template || 'schedule'}.hbs`;
      // Load template and compile
      const filePath = path.join(
        process.cwd(),
        config.theme || 'theme',
        config.template || 'templates',
        template,
      );
      const output = Handlebars.compile(await fs.readFile(filePath, 'utf-8'))(page);
      await fs.ensureDir(outputDir);
      // if home page skip else create page dir
      const dir = url !== 'index' ? path.join(outputDir, url) : outputDir;
      await fs.ensureDir(dir);
      await fs.writeFile(path.join(dir, 'index.html'), output, 'utf8');
    } catch (err) {
      throw err;
    }
  };
}