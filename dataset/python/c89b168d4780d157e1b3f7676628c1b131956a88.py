def start_capture(upcoming_event):
    '''Start the capture process, creating all necessary files and directories
    as well as ingesting the captured files if no backup mode is configured.
    '''
    logger.info('Start recording')

    # First move event to recording_event table
    db = get_session()
    event = db.query(RecordedEvent)\
              .filter(RecordedEvent.uid == upcoming_event.uid)\
              .filter(RecordedEvent.start == upcoming_event.start)\
              .first()
    if not event:
        event = RecordedEvent(upcoming_event)
        db.add(event)
        db.commit()

    try_mkdir(config()['capture']['directory'])
    os.mkdir(event.directory())

    # Set state
    update_event_status(event, Status.RECORDING)
    recording_state(event.uid, 'capturing')
    set_service_status_immediate(Service.CAPTURE, ServiceStatus.BUSY)

    # Recording
    tracks = recording_command(event)
    event.set_tracks(tracks)
    db.commit()

    # Set status
    update_event_status(event, Status.FINISHED_RECORDING)
    recording_state(event.uid, 'capture_finished')
    set_service_status_immediate(Service.CAPTURE, ServiceStatus.IDLE)

    logger.info('Finished recording')