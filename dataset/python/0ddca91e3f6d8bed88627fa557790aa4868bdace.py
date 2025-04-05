def jsonify_good_event(event, known_fields=ENRICHED_EVENT_FIELD_TYPES, add_geolocation_data=True):
    """
    Convert a Snowplow enriched event in the form of an array of fields into a JSON
    """
    if len(event) != len(known_fields):
        raise SnowplowEventTransformationException(
            ["Expected {} fields, received {} fields.".format(len(known_fields), len(event))]
        )
    else:
        output = {}
        errors = []
        if add_geolocation_data and event[LATITUDE_INDEX] != '' and event[LONGITUDE_INDEX] != '':
            output['geo_location'] = event[LATITUDE_INDEX] + ',' + event[LONGITUDE_INDEX]
        for i in range(len(event)):
            key = known_fields[i][0]
            if event[i] != '':
                try:
                    kvpairs = known_fields[i][1](key, event[i])
                    for kvpair in kvpairs:
                        output[kvpair[0]] = kvpair[1]
                except SnowplowEventTransformationException as sete:
                    errors += sete.error_messages
                except Exception as e:
                    errors += ["Unexpected exception parsing field with key {} and value {}: {}".format(
                        known_fields[i][0],
                        event[i],
                        repr(e)
                    )]
        if errors:
            raise SnowplowEventTransformationException(errors)
        else:
            return output