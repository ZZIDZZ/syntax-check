def run
            program :name, 'mixml'
            program :version, Mixml::VERSION
            program :description, 'XML helper tool'

            $tool = Mixml::Tool.new

            global_option('-p', '--pretty', 'Pretty print output') do |value|
                $tool.pretty = value
            end

            global_option('-i', '--inplace', 'Replace the processed files with the new files') do |value|
                $tool.save = value
                $tool.print = !value
            end

            global_option('-q', '--quiet', 'Do not print nodes') do |value|
                $tool.print = !value
            end

            command :pretty do |c|
                c.description = 'Pretty print XML files'
                c.action do |args, options|
                    $tool.pretty = true
                    $tool.work(args)
                end
            end

            modify_command :write do |c|
                c.description = 'Write selected nodes to the console'
                c.suppress_output = true
                c.optional_expression = true
            end

            select_command :remove do |c|
                c.description = 'Remove nodes from the XML documents'
            end

            modify_command :replace do |c|
                c.description = 'Replace nodes in the XML documents'
            end

            modify_command :append do |c|
                c.description = 'Append child nodes in the XML documents'
            end

            modify_command :rename do |c|
                c.description = 'Rename nodes in the XML documents'
            end

            modify_command :value do |c|
                c.description = 'Set node values'
            end

            command :execute do |c|
                c.description = 'Execute script on the XML documents'
                c.option '-s', '--script STRING', String, 'Script file to execute'
                c.option '-e', '--expression STRING', String, 'Command to execute'
                c.action do |args, options|
                    script = options.expression || File.read(options.script)

                    $tool.work(args) do
                        execute(script)
                    end
                end
            end

            run!
        end