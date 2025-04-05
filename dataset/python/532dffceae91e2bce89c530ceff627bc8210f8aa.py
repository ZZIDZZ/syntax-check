def iter_osm_notes(feed_limit=25, interval=60, parse_timestamps=True):
    """ Parses the global OSM Notes feed and yields as much Note information as possible. """

    last_seen_guid = None
    while True:
        u = urllib2.urlopen('https://www.openstreetmap.org/api/0.6/notes/feed?limit=%d' % feed_limit)

        tree = etree.parse(u)

        new_notes = []
        for note_item in tree.xpath('/rss/channel/item'):
            title = note_item.xpath('title')[0].text

            if title.startswith('new note ('):
                action = 'create'
            elif title.startswith('new comment ('):
                action = 'comment'
            elif title.startswith('closed note ('):
                action = 'close'

            # Note that (at least for now) the link and guid are the same in the feed.
            guid = note_item.xpath('link')[0].text

            if last_seen_guid == guid:
                break
            elif last_seen_guid == None:
                # The first time through we want the first item to be the "last seen"
                # because the RSS feed is newest-to-oldest
                last_seen_guid = guid
            else:
                note_id = int(guid.split('/')[-1].split('#c')[0])
                new_notes.append((action, get_note(note_id, parse_timestamps)))

        # We yield the reversed list because we want to yield in change order
        # (i.e. "oldest to most current")
        for note in reversed(new_notes):
            yield note

        yield model.Finished(None, None)

        time.sleep(interval)