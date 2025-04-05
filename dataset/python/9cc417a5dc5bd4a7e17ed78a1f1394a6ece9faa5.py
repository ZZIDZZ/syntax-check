def find_links(url):
    """
    Find the href destinations of all links at  URL

    Arguments:
    - `url`:

    Return: list[str]
    Exceptions: None
    """
    url = protocolise(url)
    content = requests.get(url).content
    flike = StringIO(content)
    root = html.parse(flike).getroot()
    atags = root.cssselect('a')
    hrefs = [a.attrib['href'] for a in atags]
    # !!! This does the wrong thing for bbc.co.uk/index.html
    hrefs = [h if h.startswith('http') else '/'.join([url, h]) for h in hrefs ]
    return hrefs