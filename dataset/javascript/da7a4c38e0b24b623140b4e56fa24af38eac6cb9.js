function( json, typeSpecification, array ) {

      var keys,
          current = json,
          nested = [],
          nestedKeys = [],
          levels = [],
          query = 'COLUMN_CREATE(',
          root = true,
          curNest = '',
          curItem,
          item = 0,
          level = 0;

    while( current ) {

      keys = Object.keys( current );
      var len = keys.length;
      var _l;
      var deepestLevel = 1;

      for( var i = 0; i < len; ++i ) {

        if( ( _l = current[ keys[ i ] ] ) === null || _l === undefined ) {
          continue;
        }

        if( typeof( _l ) === 'object' ) {

          // skip empty objects, we do not store them,
          // this needs us to set NULL instead
          if( !Object.keys( _l ).length ) {

            _l = null;
            if( !typeSpecification ) {
              query += '\'' + keys[ i ].replace(/\\/g, '\\\\')
                .replace(/\u0008/g, '\\b')
                .replace(/'/g, '\\\'')
                .replace(/\u0000/g, '\\0') + '\', NULL, ';
            }
            else {
              query += '?, NULL, ';
              array.push( keys[ i ] );
            }

            continue;
          }

          nested.push( _l );
          nestedKeys.push( keys[ i ] );
          if ( curItem !== item ) {
              curItem = item;
              ++level;

              levels.push( { level: level - 1, nestSep: curNest + ')' } );
          }
          else {
            levels.push( { level: level - 1, nestSep: ')' } );
          }

          //save nesting level
        }
        else {

          var queryType = typeof( _l );
          if( !typeSpecification ) {
            query += '\'' + keys[ i ].replace(/\\/g, '\\\\')
              .replace(/\u0008/g, '\\b')
              .replace(/'/g, '\\\'')
              .replace(/\u0000/g, '\\0') + '\', ';
          }
          else {
            query += '?, ';
            array.push( keys[ i ] );
          }

          switch( queryType ) {

            case 'boolean':
              query += ( ( _l === true ) ? 1 : 0 ) + ' AS unsigned integer, ';
              break;

            case 'number':
              query += _l + ' AS double, ';
              break;

            default:

              if( !typeSpecification ) {

                query += '\'' + _l.replace(/\\/g, '\\\\')
                .replace(/\u0008/g, '\\b')
                .replace(/'/g, '\\\'')
                .replace(/\u0000/g, '\\0') + '\', ';
              }
              else {
                query += '?, ';
                array.push( _l );
              }
              break;
          }
        }
      }

      if( root ) {

        root = false;
      }
      else {

        if( level === 0 )
          query = query.substring( 0, query.length - 2 ) + curNest + ', ';
      }

      if( nested.length !== 0 ) {

        if( !typeSpecification ) {
          query += '\'' + nestedKeys.pop().replace(/\\/g, '\\\\')
            .replace(/\u0008/g, '\\b')
            .replace(/'/g, '\\\'')
            .replace(/\u0000/g, '\\0') + '\', COLUMN_CREATE(';
        }
        else {
          query += '?, COLUMN_CREATE(';
          array.push( nestedKeys.pop() );
        }
      }
      else {
        query = query.substring( 0, query.length - 2 );
      }

      current = nested.pop();
      ++item;

      //restore nesting level
      level = levels.pop() || 0;
      if ( level ) {

        curNest = level.nestSep;
        level = level.level;
      }

      deepestLevel = level + 1;
    }

    query += ')';

    return query;
  }