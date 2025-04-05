function remDir(path) {
			return (new Promise(async (resolve, _reject) => {
				if (fs.existsSync(path)) {
					let files = fs.readdirSync(path);
					let promiseArray = [];

					for (let fileIndex = 0; fileIndex < files.length; fileIndex++) {
						promiseArray.push(new Promise(async (resolve2, _reject2) => {
							let curPath = path + '/' + files[fileIndex];
							if (fs.lstatSync(curPath).isDirectory()) {
								// recurse
								await remDir(curPath);
								resolve2();
							} else {
								// delete file
								log.v('Removing Entity ', files[fileIndex].split('.')[0]);
								fs.unlinkSync(curPath);
								resolve2();
							}
						}));
					}
					//make sure all the sub files and directories have been removed;
					await Promise.all(promiseArray);
					log.v('Removing Module Directory ', path);
					fs.rmdirSync(path);
					resolve();
				} else {
					log.v('trying to remove nonexistant path ', path);
					resolve();
				}
			}));
		}