def download(self):
        """Download the EMNIST data if it doesn't exist in processed_folder already."""
        import shutil
        import zipfile

        if self._check_exists():
            return

        makedir_exist_ok(self.raw_folder)
        makedir_exist_ok(self.processed_folder)

        # download files
        filename = self.url.rpartition('/')[2]
        file_path = os.path.join(self.raw_folder, filename)
        download_url(self.url, root=self.raw_folder, filename=filename, md5=None)

        print('Extracting zip archive')
        with zipfile.ZipFile(file_path) as zip_f:
            zip_f.extractall(self.raw_folder)
        os.unlink(file_path)
        gzip_folder = os.path.join(self.raw_folder, 'gzip')
        for gzip_file in os.listdir(gzip_folder):
            if gzip_file.endswith('.gz'):
                self.extract_gzip(gzip_path=os.path.join(gzip_folder, gzip_file))

        # process and save as torch files
        for split in self.splits:
            print('Processing ' + split)
            training_set = (
                read_image_file(os.path.join(gzip_folder, 'emnist-{}-train-images-idx3-ubyte'.format(split))),
                read_label_file(os.path.join(gzip_folder, 'emnist-{}-train-labels-idx1-ubyte'.format(split)))
            )
            test_set = (
                read_image_file(os.path.join(gzip_folder, 'emnist-{}-test-images-idx3-ubyte'.format(split))),
                read_label_file(os.path.join(gzip_folder, 'emnist-{}-test-labels-idx1-ubyte'.format(split)))
            )
            with open(os.path.join(self.processed_folder, self._training_file(split)), 'wb') as f:
                torch.save(training_set, f)
            with open(os.path.join(self.processed_folder, self._test_file(split)), 'wb') as f:
                torch.save(test_set, f)
        shutil.rmtree(gzip_folder)

        print('Done!')