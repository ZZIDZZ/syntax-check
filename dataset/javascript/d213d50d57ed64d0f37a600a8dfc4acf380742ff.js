function(comment) {
              const isLicense =
                comment.toLowerCase().includes("license") ||
                comment.toLowerCase().includes("copyright");
              if (isLicense === false) {
                return false;
              }
              if (lastLicense !== comment) {
                lastLicense = comment;
                return true;
              } else {
                return false;
              }
            }