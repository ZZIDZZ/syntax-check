async def send_message():
    """Example of sending a message."""
    jar = aiohttp.CookieJar(unsafe=True)
    websession = aiohttp.ClientSession(cookie_jar=jar)

    modem = eternalegypt.Modem(hostname=sys.argv[1], websession=websession)
    await modem.login(password=sys.argv[2])

    await modem.sms(phone=sys.argv[3], message=sys.argv[4])

    await modem.logout()
    await websession.close()