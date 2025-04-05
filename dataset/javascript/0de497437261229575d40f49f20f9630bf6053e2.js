function addRoutes( pies, pie, routes, app ) {
    // Add the GET routes
    if ( 'get' in routes ) {
        routes.get.forEach( function( route ) {
            Object.keys( route ).forEach( function( r ) {
                var middlewares = true;
                if ( typeof route[ r ] === 'string' ) {
                    middlewares = false;
                }
                loadRoute( app, 'get', r, pies[ pie ].path, route[ r ], middlewares );
            });
        });
    }

    // Add the POST routes
    if ( 'post' in routes ) {
        routes.post.forEach( function( route ) {
            Object.keys( route ).forEach( function( r ) {
                var middlewares = true;
                if ( typeof route[ r ] === 'string' ) {
                    middlewares = false;
                }
                loadRoute( app, 'post', r, pies[ pie ].path, route[ r ], middlewares );
            });
        });
    }
}