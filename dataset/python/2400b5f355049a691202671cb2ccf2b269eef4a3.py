def animate(frames, interval, name, iterations=2):
    """Animate given frame for set number of iterations.

    Parameters
    ----------
    frames : list
        Frames for animating
    interval : float
        Interval between two frames
    name : str
        Name of animation
    iterations : int, optional
        Number of loops for animations
    """
    for i in range(iterations):
        for frame in frames:
            frame = get_coded_text(frame)
            output = "\r{0} {1}".format(frame, name)
            sys.stdout.write(output)
            sys.stdout.write(CLEAR_LINE)
            sys.stdout.flush()
            time.sleep(0.001 * interval)