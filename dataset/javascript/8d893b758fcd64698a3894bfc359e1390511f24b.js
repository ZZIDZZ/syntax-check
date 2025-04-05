async function (fname, attrs) {
        
        let partialDirs;

        if (typeof module.exports.configuration.partialDirs === 'undefined'
         || !module.exports.configuration.partialDirs
         || module.exports.configuration.partialDirs.length <= 0) {
            partialDirs = [ __dirname ];
         } else {
            partialDirs = module.exports.configuration.partialDirs;
         }

        var partialFound = await globfs.findAsync(partialDirs, fname);
        if (!partialFound) throw new Error(`No partial found for ${fname} in ${util.inspect(partialDirs)}`);
        // Pick the first partial found
        partialFound = partialFound[0];
        // console.log(`module.exports.configuration renderPartial ${partialFound}`);
        if (!partialFound) throw new Error(`No partial found for ${fname} in ${util.inspect(partialDirs)}`);
    
        var partialFname = path.join(partialFound.basedir, partialFound.path);
        var stats = await fs.stat(partialFname);
        if (!stats.isFile()) {
            throw new Error(`doPartialAsync non-file found for ${fname} - ${partialFname}`);
        }
        var partialText = await fs.readFile(partialFname, 'utf8');
        if (/\.ejs$/i.test(partialFname)) {
            try { return ejs.render(partialText, attrs); } catch (e) {
                throw new Error(`EJS rendering of ${fname} failed because of ${e}`);
            }
        } /* else if (/\.literal$/i.test(partialFname)) {
            try {
                const t = literal(partialText);
                return t(attrs);
            } catch (e) {
                throw new Error(`Literal rendering of ${fname} failed because of ${e}`);
            }
        } */ else if (/\.html$/i.test(partialFname)) {
            // NOTE: The partialBody gets lost in this case
            return partialText;
        } else {
            throw new Error("No rendering support for ${fname}");
        }
    }