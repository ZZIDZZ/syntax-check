function( str ) {
         str = ( str || '' ).replace( ts.regex.spaces, ' ' ).replace( ts.regex.shortDateReplace, '/' );
         return ts.regex.shortDateTest.test( str );
      }