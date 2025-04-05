public void bind( final FilterBinding handler )
    {
        final Method method = handler.getMethod();
        final String path = handler.getPath();

        logger.info( "Using appId: {} and default version: {}", appAcceptId, defaultVersion );
        List<String> versions = handler.getVersions();
        if ( versions == null || versions.isEmpty() )
        {
            versions = Collections.singletonList( defaultVersion );
        }

        for ( final String version : versions )
        {
            final Set<Method> methods = new HashSet<>();
            if ( method == Method.ANY )
            {
                for ( final Method m : Method.values() )
                {
                    methods.add( m );
                }
            }
            else
            {
                methods.add( method );
            }

            for ( final Method m : methods )
            {
                final BindingKey key = new BindingKey( m, version );

                logger.info( "ADD: {}, Pattern: {}, Filter: {}\n", key, path, handler );
                List<PatternFilterBinding> allFilterBindings = this.filterBindings.get( key );
                if ( allFilterBindings == null )
                {
                    allFilterBindings = new ArrayList<>();
                    this.filterBindings.put( key, allFilterBindings );
                }

                boolean found = false;
                for ( final PatternFilterBinding binding : allFilterBindings )
                {
                    if ( binding.getPattern()
                                .pattern()
                                .equals( handler.getPath() ) )
                    {
                        binding.addFilter( handler );
                        found = true;
                        break;
                    }
                }

                if ( !found )
                {
                    final PatternFilterBinding binding = new PatternFilterBinding( handler.getPath(), handler );
                    allFilterBindings.add( binding );
                }
            }
        }
    }