def librarian_install_modules(directory, module_name)
      hosts.each do |host|
        sut_dir = File.join('/tmp', module_name)
        scp_to host, directory, sut_dir

        on host, "cd #{sut_dir} && librarian-puppet install --clean --verbose --path #{host['distmoduledir']}"

        puppet_module_install(:source => directory, :module_name => module_name)
      end
    end