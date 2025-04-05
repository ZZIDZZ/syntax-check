def pmmap_grouped(data)
    pmmap_grouped = ['rss', 'size', 'pss', 'shared_clean', 
                     'shared_dirty', 'private_clean', 'private_dirty', 
                     'referenced', 'anonymous', 'swap']
    os_list = []
    data.each do |k, v|
      os = OpenStruct.new
      os.path = k
      pmmap_grouped.each_index {|i| os[pmmap_grouped[i]] = v[i]}
      os_list.push(os)
    end
    os_list
  end