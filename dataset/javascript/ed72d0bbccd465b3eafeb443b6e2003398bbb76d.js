function compileIndex() {
    fs.readFile(path.join(__dirname, 'templates', 'index.hogan'), function(err, data) {
        if (err) throw err;
        // write rendered result to index.html
        fs.writeFile(path.join(__dirname, 'index.html'),
                    hogan.compile(data.toString()).render({
                        'schemes': schemes, 
                        'variations': variations, 
                        'colors': colors, 
                        'variants': variants,
                        }),
                    function(err) {if (err) throw err});
        
        // open index.html in browser
        open(path.join(__dirname, 'index.html'));
    });
}