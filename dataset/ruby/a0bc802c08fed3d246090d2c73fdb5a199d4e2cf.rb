def article(id)
      url = index.knowledgeManagement.articles.article
      url = url(url, ArticleID: id)
      decorate(get(url).body) { |o| autodefine(o) }
    end