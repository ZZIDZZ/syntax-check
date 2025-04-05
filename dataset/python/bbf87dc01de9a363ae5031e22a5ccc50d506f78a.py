def download_music(song, thread_num=4):
    """
    process for downing music with multiple threads
    """
    filename = "{}.mp3".format(song["name"])

    if os.path.exists(filename):
        os.remove(filename)

    part = int(song["size"] / thread_num)
    if part <= 1024:
        thread_num = 1

    _id = uuid.uuid4().hex

    logger.info("downloading '{}'...".format(song["name"]))

    threads = []
    for i in range(thread_num):
        if i == thread_num - 1:
            end = ''
        else:
            end = (i + 1) * part - 1
        thread = Worker((i * part, end), song, _id)
        thread.start()
        threads.append(thread)

    for t in threads:
        t.join()

    fileParts = glob.glob("part-{}-*".format(_id))
    fileParts.sort(key=lambda e: e.split('-')[-1])

    logger.info("'{}' combine parts...".format(song["name"]))
    with open(filename, "ab") as f:
        for part in fileParts:
            with open(part, "rb") as d:
                shutil.copyfileobj(d, f)
            os.remove(part)
    logger.info("'{}' finished".format(song["name"]))