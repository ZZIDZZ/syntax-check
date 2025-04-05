public function sitemapAction(Request $request)
    {
        $sitemap = $request->attributes->get('sitemap', null);

        $registry = $this->get('ekyna_sitemap.provider_registry');
        $providers = $registry->getProvidersBySitemap($sitemap);

        if (0 === count($providers)) {
            throw new NotFoundHttpException('Sitemap not found.');
        }

        $lastUpdateDate = null;
        /** @var \Ekyna\Bundle\SitemapBundle\Provider\ProviderInterface $provider */
        foreach($providers as $provider) {
            if (null === $lastUpdateDate || $lastUpdateDate < $provider->getLastUpdateDate()) {
                $lastUpdateDate = $provider->getLastUpdateDate();
            }
        }

        $response = new Response();
        $response->setLastModified($lastUpdateDate);
        $response->setPublic();
        if ($response->isNotModified($request)) {
            return $response;
        }
        $response->setMaxAge($this->container->getParameter('ekyna_sitemap.sitemap_ttl'));
        $response->headers->add(['Content-Type' => 'application/xml; charset=UTF-8']);

        return $response->setContent($this->renderView('EkynaSitemapBundle:Sitemap:sitemap.xml.twig', [
            'providers' => $providers,
        ]));
    }