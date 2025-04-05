def footnote_html(id, time)
      footnote_label = Build.tag("span", Build.tag("sup", id.to_s), :class => "footnote-number")
      footnote_content = sequence.elements.map { |s| s.html }.join
      Build.tag("div", footnote_label + footnote_content, :id => "footnote#{id}#{time}", :class => "footnote")
    end