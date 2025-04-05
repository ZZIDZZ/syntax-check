def load_setup( name )
    reader = create_fixture_reader( name )

    reader.each do |fixture_name|
      load( fixture_name )
    end
  end