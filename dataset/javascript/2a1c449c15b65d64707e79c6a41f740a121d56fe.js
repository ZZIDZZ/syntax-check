function(err, data) {

          if(err) {
            prCB(err);
          }

          prCB(null, data);
          db.close();
        }