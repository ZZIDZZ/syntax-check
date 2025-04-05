function cellAccessor(row1, col1, row2, col2, isMerged) {
    let theseCells = new cellBlock();
    theseCells.ws = this;

    row2 = row2 ? row2 : row1;
    col2 = col2 ? col2 : col1;

    if (row2 > this.lastUsedRow) {
        this.lastUsedRow = row2;
    }

    if (col2 > this.lastUsedCol) {
        this.lastUsedCol = col2;
    }

    for (let r = row1; r <= row2; r++) {
        for (let c = col1; c <= col2; c++) {
            let ref = `${utils.getExcelAlpha(c)}${r}`;
            if (!this.cells[ref]) {
                this.cells[ref] = new Cell(r, c);
            }
            if (!this.rows[r]) {
                this.rows[r] = new Row(r, this);
            }
            if (this.rows[r].cellRefs.indexOf(ref) < 0) {
                this.rows[r].cellRefs.push(ref);
            }

            theseCells.cells.push(this.cells[ref]);
            theseCells.excelRefs.push(ref);
        }
    }
    if (isMerged) {
        theseCells.merged = true;
        mergeCells(theseCells);
    }

    return theseCells;
}