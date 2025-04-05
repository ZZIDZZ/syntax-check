def plot_mdr_grid(mdr_instance):
    """Visualizes the MDR grid of a given fitted MDR instance. Only works for 2-way MDR models.
    
    This function is currently incomplete.

    Parameters
    ----------
    mdr_instance: object
        A fitted instance of the MDR type to visualize.

    Returns
    ----------
    fig: matplotlib.figure
        Figure object for the visualized MDR grid.

    """
    var1_levels = list(set([variables[0] for variables in mdr_instance.feature_map]))
    var2_levels = list(set([variables[1] for variables in mdr_instance.feature_map]))
    max_count = np.array(list(mdr_instance.class_count_matrix.values())).flatten().max()

    """
    TODO:
        - Add common axis labels
        - Make sure this scales for smaller and larger record sizes
        - Extend to 3-way+ models, e.g., http://4.bp.blogspot.com/-vgKCjEkWFUc/UPwPuHo6XvI/AAAAAAAAAE0/fORHqDcoikE/s1600/model.jpg
    """

    fig, splots = plt.subplots(ncols=len(var1_levels), nrows=len(var2_levels), sharey=True, sharex=True)
    fig.set_figwidth(6)
    fig.set_figheight(6)

    for (var1, var2) in itertools.product(var1_levels, var2_levels):
        class_counts = mdr_instance.class_count_matrix[(var1, var2)]
        splot = splots[var2_levels.index(var2)][var1_levels.index(var1)]
        splot.set_yticks([])
        splot.set_xticks([])
        splot.set_ylim(0, max_count * 1.5)
        splot.set_xlim(-0.5, 1.5)

        if var2_levels.index(var2) == 0:
            splot.set_title('X1 = {}'.format(var1), fontsize=12)
        if var1_levels.index(var1) == 0:
            splot.set_ylabel('X2 = {}'.format(var2), fontsize=12)

        bars = splot.bar(left=range(class_counts.shape[0]),
                         height=class_counts, width=0.5,
                         color='black', align='center')

        bgcolor = 'lightgrey' if mdr_instance.feature_map[(var1, var2)] == 0 else 'darkgrey'
        splot.set_axis_bgcolor(bgcolor)
        for index, bar in enumerate(bars):
            splot.text(index, class_counts[index] + (max_count * 0.1), class_counts[index], ha='center')

    fig.tight_layout()
    return fig