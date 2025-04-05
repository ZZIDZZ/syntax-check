protected function createNodePages()
    {
        /* @var $terms Vocabulary */
        foreach ($this->taxonomies as $plural => $terms) {
            if (count($terms) > 0) {
                /*
                 * Creates $plural/$term pages (list of pages)
                 * ex: /tags/tag-1/
                 */
                /* @var $pages PageCollection */
                foreach ($terms as $term => $pages) {
                    if (!$this->pageCollection->has($term)) {
                        $pages = $pages->sortByDate()->toArray();
                        $page = (new Page())
                            ->setId(Page::urlize(sprintf('%s/%s/', $plural, $term)))
                            ->setPathname(Page::urlize(sprintf('%s/%s', $plural, $term)))
                            ->setTitle(ucfirst($term))
                            ->setNodeType(NodeType::TAXONOMY)
                            ->setVariable('pages', $pages)
                            ->setVariable('date', $date = reset($pages)->getDate())
                            ->setVariable('singular', $this->config->get('site.taxonomies')[$plural])
                            ->setVariable('pagination', ['pages' => $pages]);
                        $this->generatedPages->add($page);
                    }
                }
                /*
                 * Creates $plural pages (list of terms)
                 * ex: /tags/
                 */
                $page = (new Page())
                    ->setId(Page::urlize($plural))
                    ->setPathname(strtolower($plural))
                    ->setTitle($plural)
                    ->setNodeType(NodeType::TERMS)
                    ->setVariable('plural', $plural)
                    ->setVariable('singular', $this->config->get('site.taxonomies')[$plural])
                    ->setVariable('terms', $terms)
                    ->setVariable('date', $date);

                // add page only if a template exist
                try {
                    $this->generatedPages->add($page);
                } catch (Exception $e) {
                    echo $e->getMessage()."\n";
                    // do not add page
                    unset($page);
                }
            }
        }
    }