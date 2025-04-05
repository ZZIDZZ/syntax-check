function finalizeBuild(sourceReport){
        // Something went wrong. Fail the build.
        if(errorCount > 0) {
          grunt.fail.warn("Coffeeification failed.");
        // The build succeeded. Call done to 
        // finish the grunt task.
        } else {
          done("Coffeified " + sourceReport.count + ": " + sourceReport.locations);
        }
      }