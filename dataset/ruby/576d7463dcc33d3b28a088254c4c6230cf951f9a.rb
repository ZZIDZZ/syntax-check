def search_words
      {}.tap do |result|
        @query.query_words.each do |query_word|
          search_word(query_word).each do |class_name, ids|
            merge_search_result_word_matches result, class_name, ids
          end
        end
      end
    end