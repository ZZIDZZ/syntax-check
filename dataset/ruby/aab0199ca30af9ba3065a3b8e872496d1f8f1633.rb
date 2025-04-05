def set2(selector, value=nil)
      elem = element(xpath: selector).to_subtype

      case elem
      when Watir::Radio
        elem.set
      when Watir::Select
        elem.select value
      when Watir::Input
        elem.set value
      when Watir::TextArea
        elem.set value
      else
        elem.click
      end
    end