def help
      puts
      print "Dev".green
      print " - available commands:\n"
      puts
      
      print "\tversion\t\t".limegreen 
        print "Prints current version.\n"
        puts

      print "\tfeature\t\t".limegreen
        print "Opens or closes a feature for the current app.\n"
        print "\t\t\tWarning: the app is determined from the current working directory!\n"
        print "\t\t\tExample: "
        print "dev feature open my-new-feature".springgreen
        print " (opens a new feature for the current app)"
        print ".\n"
        print "\t\t\tExample: "
        print "dev feature close my-new-feature".springgreen
        print " (closes a developed new feature for the current app)"
        print ".\n"
        puts

      print "\thotfix\t\t".limegreen
        print "Opens or closes a hotfix for the current app.\n"
        print "\t\t\tWarning: the app is determined from the current working directory!\n"
        print "\t\t\tExample: "
        print "dev hotfix open 0.2.1".springgreen
        print " (opens a new hotfix for the current app)"
        print ".\n"
        print "\t\t\tExample: "
        print "dev hotfix close 0.2.1".springgreen
        print " (closes a developed new hotfix for the current app)"
        print ".\n"
        puts

      print "\trelease\t\t".limegreen
        print "Opens or closes a release for the current app.\n"
        print "\t\t\tWarning: the app is determined from the current working directory!\n"
        print "\t\t\tExample: "
        print "dev release open 0.2.0".springgreen
        print " (opens a new release for the current app)"
        print ".\n"
        print "\t\t\tExample: "
        print "dev release close 0.2.0".springgreen
        print " (closes a developed new release for the current app)"
        print ".\n"
        puts

      print "\tpull\t\t".limegreen
        print "Pulls specified app's git repository, or pulls all apps if none are specified.\n"
        print "\t\t\tWarning: the pulled branch is the one the app is currently on!\n"
        print "\t\t\tExample: "
        print "dev pull [myapp]".springgreen
        print ".\n"
        puts

      print "\tpush\t\t".limegreen
        print "Commits and pushes the specified app.\n"
        print "\t\t\tWarning: the pushed branch is the one the app is currently on!\n"
        print "\t\t\tExample: "
        print "dev push myapp \"commit message\"".springgreen
        print ".\n"
        puts

      print "\ttest\t\t".limegreen
        print "Runs the app's test suite. Tests must be written with rspec.\n"
        print "\t\t\tIt is possibile to specify which app's test suite to run.\n"
        print "\t\t\tIf nothing is specified, all main app's test suites are run.\n"
        print "\t\t\tExample: "
        print "dev test mymainapp myengine".springgreen
        print " (runs tests for 'mymainapp' and 'myengine')"
        print ".\n"
        print "\t\t\tExample: "
        print "dev test".springgreen
        print " (runs tests for all main apps and engines within this project)"
        print ".\n"
        puts
    end