function calculateFieldColor(selectedColor, nonSelectedColor, focusedColor, index, out)
{
    if(selected.indexOf(index) !== -1 && focused == index)
    return chalk.bold.rgb(selectedColor.r, selectedColor.g, selectedColor.b)(out);
    if(selected.indexOf(index) !== -1) // this goes before focused so selected color gets priority over focused values
        return chalk.rgb(selectedColor.r, selectedColor.g, selectedColor.b)(out);
    if(focused == index)
        return chalk.bold.rgb(focusedColor.r, focusedColor.g, focusedColor.b)(out);
    return chalk.rgb(nonSelectedColor.r, nonSelectedColor.g, nonSelectedColor.b)(out);
}