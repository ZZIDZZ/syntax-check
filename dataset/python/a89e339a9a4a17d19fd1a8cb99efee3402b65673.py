def _create_file():
    """
    Returns a file handle which is used to record audio
    """
    f = wave.open('audio.wav', mode='wb')
    f.setnchannels(2)
    p = pyaudio.PyAudio()
    f.setsampwidth(p.get_sample_size(pyaudio.paInt16))
    f.setframerate(p.get_default_input_device_info()['defaultSampleRate'])
    try:
        yield f
    finally:
        f.close()