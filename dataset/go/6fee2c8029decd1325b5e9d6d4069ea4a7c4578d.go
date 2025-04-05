func (fs *BtrfsFilesystem) Create(bytes uint64) error {

	// significantly
	idempotent := exec.Command("bash", "-e", "-x", "-c", `
		if [ ! -e $IMAGE_PATH ] || [ "$(stat --printf="%s" $IMAGE_PATH)" != "$SIZE_IN_BYTES" ]; then
			touch $IMAGE_PATH
			truncate -s ${SIZE_IN_BYTES} $IMAGE_PATH
		fi

		lo="$(losetup -j $IMAGE_PATH | cut -d':' -f1)"
		if [ -z "$lo" ]; then
			lo="$(losetup -f --show $IMAGE_PATH)"
		fi

		if ! file $IMAGE_PATH | grep BTRFS; then
			`+fs.mkfsBin+` --nodiscard $IMAGE_PATH
		fi

		mkdir -p $MOUNT_PATH

		if ! mountpoint -q $MOUNT_PATH; then
			mount -t btrfs $lo $MOUNT_PATH
		fi
	`)

	idempotent.Env = []string{
		"PATH=" + os.Getenv("PATH"),
		"MOUNT_PATH=" + fs.mountPath,
		"IMAGE_PATH=" + fs.imagePath,
		fmt.Sprintf("SIZE_IN_BYTES=%d", bytes),
	}

	_, err := fs.run(idempotent)
	return err
}