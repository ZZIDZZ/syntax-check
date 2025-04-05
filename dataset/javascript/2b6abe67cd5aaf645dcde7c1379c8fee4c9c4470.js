function parseMessage(data) {
    switch (data.topic) {
      // https://dev.twitch.tv/docs/v5/guides/PubSub/
      case 'channel-bits-events-v1.' + state.channel_id:
        bits();
        break;
      // https://discuss.dev.twitch.tv/t/in-line-broadcaster-chat-mod-logs/7281/12
      case 'chat_moderator_actions.' + state.id + '.' + state.id:
        moderation();
        break;
      case 'whispers.' + state.id:
        whisper();
        break;
      // case 'channel-subscribe-events-v1.' + state.channel_id:
      //   sub();
      //   break;
      default:
        break;
    }

    function bits() {
      let bits = JSON.parse(data.message);
      _event('bits', bits);
    }

    function moderation() {
      let moderation = JSON.parse(data.message).data;
      _event('moderation', moderation);
    }

    function whisper() {
      let message = JSON.parse(data.message).data_object;
      // TODO: figure out why some whispers are dropped...
      // _event('whisper', message);
    }

    // function sub() {
    //   // TODO: https://discuss.dev.twitch.tv/t/subscriptions-beta-changes/10023
    // }

  }