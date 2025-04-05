def crank_it(what, overrides)
        if what.to_s =~ /(.*)_attrs$/
          what = $1
          overrides = overrides.merge(:_return_attributes => true)
        end
        item = "TBD"
        new_job(what, overrides) do
          item = self.send(what)        # Invoke the factory method
          item = apply_traits(what, item)
        end
        item
      end