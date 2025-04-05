public function downloadAll($directory)
    {
        if (!file_exists($directory)) {
            if (!@mkdir($directory, null, true)) {
                throw new DownloadException("The download directory cannot be created.");
            }
        }

        $client = new Client();

        $requests = [];
        foreach ($this->wallpapers as $w) {
            $url = $w->getImageUrl(true);

            $requests[] = $client->createRequest('GET', $url, [
                'save_to' => $directory . '/' . basename($url)
            ]);
        }

        $results = Pool::batch($client, $requests);

        // Retry with PNG
        $retryRequests = [];
        foreach ($results->getFailures() as $e) {
            // Delete failed files
            unlink($directory . '/' . basename($e->getRequest()->getUrl()));

            $urlPng = str_replace('.jpg', '.png', $e->getRequest()->getUrl());
            $statusCode = $e->getResponse()->getStatusCode();

            if ($statusCode == 404) {
                $retryRequests[] = $client->createRequest('GET', $urlPng, [
                    'save_to' => $directory . '/' . basename($urlPng)
                ]);
            }
        }

        Pool::batch($client, $retryRequests);
    }