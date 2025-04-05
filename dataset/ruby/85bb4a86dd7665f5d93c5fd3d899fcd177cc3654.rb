def run(*commands)
      context = case
                when @_context.is_a?(Hash) && @_context[:tabs]
                  @_context[:tabs]['default'][:commands]
                when @_context.is_a?(Hash)
                  @_context[:commands]
                else
                  @_context
                end
      context << commands.map { |c| c =~ /&$/ ? "(#{c})" : c }.join(" && ")
    end