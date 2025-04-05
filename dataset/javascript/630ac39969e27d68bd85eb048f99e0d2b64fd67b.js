function updateRow() {
    let tableName = arguments[0];
    var fname = '';
    var where;
    var set;
    var callback;

    if (arguments.length === 4) {
        fname = path.join(userData, tableName + '.json');
        where = arguments[1];
        set = arguments[2];
        callback = arguments[3];
    } else if (arguments.length === 5) {
        fname = path.join(arguments[1], arguments[0] + '.json');
        where = arguments[2];
        set = arguments[3];
        callback = arguments[4];
    }

    let exists = fs.existsSync(fname);

    let whereKeys = Object.keys(where);
    let setKeys = Object.keys(set);

    if (exists) {
        let table = JSON.parse(fs.readFileSync(fname));
        let rows = table[tableName];

        let matched = 0; // Number of matched complete where clause
        let matchedIndex = 0;

        for (var i = 0; i < rows.length; i++) {

            for (var j = 0; j < whereKeys.length; j++) {
                // Test if there is a matched key with where clause and single row of table
                if (rows[i].hasOwnProperty(whereKeys[j])) {
                    if (rows[i][whereKeys[j]] === where[whereKeys[j]]) {
                        matched++;
                        matchedIndex = i;
                    }
                }
            }
        }

        if (matched === whereKeys.length) {
            // All field from where clause are present in this particular
            // row of the database table
            try {
                for (var k = 0; k < setKeys.length; k++) {
                    // rows[i][setKeys[k]] = set[setKeys[k]];
                    rows[matchedIndex][setKeys[k]] = set[setKeys[k]];
                }

                // Create a new object and pass the rows
                let obj = new Object();
                obj[tableName] = rows;

                // Write the object to json file
                try {
                    fs.writeFileSync(fname, JSON.stringify(obj, null, 2), (err) => {

                    })

                    callback(true, "Success!")
                    return;
                } catch (e) {
                    callback(false, e.toString());
                    return;
                }

                callback(true, rows);
            } catch (e) {
                callback(false, e.toString());
                return;
            }
        } else {
            callback(false, "Cannot find the specified record.");
            return;
        }


    } else {
        callback(false, 'Table file does not exist!');
        return;
    }
}