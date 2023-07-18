<?php

class FileSystems {
	
	const EXTENSIONS = array(
		'documents' => array('doc','docx','odf','odp','ods','odt','otf','ppt','csv','pps','pptx','xls','xlsx','rtf','txt','pdf'),
		'images' => array('jpg','jpeg','png','tif','webp','bmp','ico','svg','gif'),
		'audios' => array('mp3','wav','wave','wma','aac','mid','midi','ogg','aif','aiff'),
		'videos' => array('mp4','mpg','mpeg','mov','3gp','avi'),
		/* 'other' => array() */
	);
	const ACCEPT_FILE_FORMAT = array(
		/*"text/*",*/
		"text/txt","text/plain","text/rtf","text/richtext","text/csv","text/xml","text/html","text/css","text/x-asm","text/javascript","text/x-java","text/x-php","text/vcard","text/x-vcard",
		"image/gif","image/png","image/jpeg","image/pjpeg","image/tiff","image/bmp","image/svg","image/webp","image/svg+xml","image/eps","image/x-eps","image/x-xcf","image/x-icon","image/vnd.microsoft.icon","image/vnd.adobe.photoshop",
		"audio/aac","audio/mpeg","audio/midi","audio/webm","audio/ogg","audio/wav","audio/wave","audio/x-wav","audio/x-pn-wav","audio/webm",
		"video/mp4","video/mpeg","video/3gpp","video/ogg","video/webm","video/msvideo","video/x-msvideo","video/avi",
		"font/otf","font/ttf","font/woff","font/woff2",
		"application/plain","application/json","application/octet-stream","application/postscript","application/x-empty","application/pkcs12","application/mspowerpoint","application/vnd.mspowerpoint","application/vnd.ms-powerpoint",
		"application/xhtml+xml","application/xml","application/pdf","application/ogg","application/zip","application/x-bzip","application/x-bzip2",
		"application/msword","application/vnd.oasis.opendocument.text","application/vnd.openxmlformats-officedocument.wordprocessingml.document",
		"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.openxmlformats-officedocument.presentationml.presentation",
		"application/vnd.oasis.opendocument.presentation","application/vnd.oasis.opendocument.spreadsheet","application/vnd.android.package-archive",
		"application/x-dosexec","application/vnd.ms-msi","application/x-msi",
		"application/dxf","application/rtf",
		"application/zip","application/x-compressed","multipart/x-zip","application/x-zip-compressed","application/x-gzip","multipart/x-gzip"
	);
	const REFUSE_FILE_FORMAT = array(
		"text/x-msdos-batch",
		"adt","app","arc","arj","asa","asd","asp","avb","ax",
		"bat","bas","bin","boo","btm",
		"cab","cbt","cdr","cer","chr","chm","cla","class","cmd","cnv","com","cpl","cpt","crt","csc","csh",
		"dat","dll","docm","dot","dotm","drv","dvb",
		"email","eml",
		"fon","fxp",
		"gms","gvb","gz",
		"hlp","hta","htlp","htr","htt",
		"inf","ini","ins","isp","its",
		"jse",
		"ksh",
		"lib","lnk",
		"mad","maf","mam","maq","mar","mas","mat","mau","mav","maw","mch","mda","mdb","mde","mdt","mdw","mdz","mht","mhtm","mhtml","mpd","mpp","mpt","msc","msg","mso","msp","mst",
		"nws",
		"obd","obj","obt","obz","ocx","oft","ops","ov?","ovl","ovr",
		"pcd","pcI","pgm","pif","pl","pot","potm","ppam","ppsm","pptm","prc","prf","prg","pwz",
		"qpw",
		"reg","rtf",
		"sbf","scf","scr","sct","sh","shb","shs","shtml","shw","sldm","smm","sys",
		"tar","td0","tgz","tlb",/*"tmp",*/"tsk","tsp","tt6",
		"url",
		"vb","vbe","vbs","vbx","vom","vs?","vsmacro","vsmacros","vss","vst","vsw","vwp","vxd","vxd","vxe",
		"wbk","wbt","wIz","wk?","wml","wms","wpc","wpd","ws","wsc","wsf","wsh","ww?",
		"xsl","xlam","xlsm","xlt","xltm"
	);
    
    protected $unite;
    // protected $basePath;
    protected $path;
    private $requests;
	
    public function __construct($basePath, object $requests = new stdClass) {
        $this->unite = array("Octets","Ko","Mo","Go");
        $this->path = $basePath;
        $this->requests = $requests;
    }
	
	/**
	 * Cette fonction prend un tableau de fichiers en entrée et les catégorise selon leur extension.
	 * Elle retourne un tableau associatif avec les catégories de fichiers, qui contiennent chacune 
	 * trois tableaux avec les chemins d'accès (src), les noms de fichiers (basename) et les dossiers 
	 * parent (path).
	 *
	 * @param array $files Le tableau des fichiers à catégoriser
	 * @param bool $basename Un booléen pour spécifier si le tableau doit contenir les noms de fichiers (true) ou non (false)
	 * @param bool $path Un booléen pour spécifier si le tableau doit contenir les dossiers parent (true) ou non (false)
	 * @return array Le tableau des catégories de fichiers
	 */
	public static function categorizeFiles(array $files, bool $basename = false, bool $path = false): array {
		$categories = array(
			'documents' => array(
				'src' => array(), 'basename' => array(), 'path' => array()
			),
			'images' => array(
				'src' => array(), 'basename' => array(), 'path' => array()
			),
			'audios' => array(
				'src' => array(), 'basename' => array(), 'path' => array()
			),
			'videos' => array(
				'src' => array(), 'basename' => array(), 'path' => array()
			),
			'other' => array(
				'src' => array(), 'basename' => array(), 'path' => array()
			)
		);
		
		foreach ($files as $file) {
			// Obtention de l'extension du fichier
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$categorized = false;
			
			foreach ($categories as $type => $category) {
				// Si l'extension du fichier est dans la liste des extensions pour cette catégorie
				if (in_array($ext, self::getExtByType($type))) {
					$categories[$type]['src'][] = $file;
					
					if ($basename == true) {
						$categories[$type]['basename'][] = basename($file);
					}
					
					if ($path == true) {
						$categories[$type]['path'][] = self::getExtractedFolder($file);
					}
					
					$categorized = true;
					break;
				}
			}
			
			if (!$categorized) {
				$categories['other']['src'][] = $file;
				
				if ($basename == true) {
					$categories['other']['basename'][] = basename($file);
				}
				
				if ($path == true) {
					$categories['other']['path'][] = self::getExtractedFolder($file);
				}
			}
		}
		return $categories;
	}
	
	/**
	 * Extrait le dossier parent du fichier à partir d'un chemin complet de fichier.
	 * 
	 * @param string $folder Le chemin complet du fichier.
	 * @return string Le dossier parent du fichier.
	 * 
	 * Cette fonction prend en entrée un chemin complet de fichier et retourne le dossier parent du fichier.
	 * Elle cherche d'abord le dossier personnel de l'utilisateur, qui se trouve immédiatement après le répertoire "uploads/datas/".
	 * Ensuite, elle extrait tous les dossiers jusqu'à ce qu'elle trouve un nom de fichier (qui contient un point ".").
	 * Elle retourne ensuite tous les dossiers précédant ce fichier.
	 * Si aucun fichier n'est trouvé dans le chemin, la fonction retourne une chaîne vide.
	 */
	public static function getExtractedFolder(string $folder): string {
		$uploads_datas = "datas";
		$folder_parts = explode("/", $folder);
		$uploads_datas_index = array_search($uploads_datas, $folder_parts);
		$personal_folder_index = $uploads_datas_index + 1;
		$personal_folder = $folder_parts[$personal_folder_index];
		
		$next_is_dir = true;
		$i = $personal_folder_index + 1;
		$extracted_folder = "";
		while ($next_is_dir && $i < count($folder_parts) - 1) {
			if (strpos($folder_parts[$i], ".") === false) {
				$extracted_folder .= "/" . $folder_parts[$i];
			} else {
				$next_is_dir = false;
			}
			$i++;
		}
		return $extracted_folder;
	}
	
	/**
	 * Récupère les extensions de fichier associées à un type donné.
	 * 
	 * @param string $type Le type de fichier pour lequel récupérer les extensions.
	 * @return array Les extensions de fichier associées au type spécifié, ou un tableau vide si le type n'existe pas.
	 */
	public static function getExtByType(string $type): array {
		if (array_key_exists($type, self::EXTENSIONS)) {
			return self::EXTENSIONS[$type];
		}
		return array();
	}
  
    public static function getSize(string|array $files, int $totalFileSize = 0): int|float {
		if( is_string($files) ) {
			$totalFileSize = $totalFileSize + filesize($files);
		} else {
			foreach($files as $size) {
				$totalFileSize = $totalFileSize + filesize($size);
			}
		}
		
		return $totalFileSize;
	}
	
	/**
     * Renvoie la taille en format lisible d'un fichier en octets, Ko, Mo ou Go.
     *
     * @param int|float $size La taille du fichier en octets.
     * @return string La taille en format lisible.
     */
    public static function getSizeName(int|float $size): string {
        $unite = array("Octets","Ko","Mo","Go");
        if ($size < 1000) {
            // Octets
            return $size ." " .$unite[0];
        } else {
            if ($size < 1000000) {
                // Ko
                $ko = round($size/1000,2);
                return $ko ." ". $unite[1];
            } else {
                if ($size < 1000000000) {
                    // Mo
                    $mo = round($size/(1000*1000),2);
                    return $mo ." ". $unite[2];
                } else {
                    // Go
                    $go = round($size/(1000*1000*1000),2);
                    return $go ." ". $unite[3];
                }
            }
        }
    }
	
	/**
	 * Récupère les fichiers dans le répertoire spécifié, en excluant les fichiers/dossiers vides, index.php et index.html.
	 *
	 * @param string $dirDest Chemin du répertoire à scanner.
	 * @return array|bool Tableau contenant les noms de fichiers trouvés ou `false` si aucun fichier n'a été trouvé.
	 */
	public static function getScanFiles(string $dirDest): array|bool {
		$files = scandir($dirDest);
		$min_files = array();
		
		foreach($files as $file) {
			if( $file != "." && $file != ".." && $file != "" && $file != "index.php" && $file != "index.html"/* && $file != "miniatures"*/ ) {
				$min_files[] = $file;
			}
		}
		
		if( isset($min_files) && !empty($min_files) ) {
			return $min_files;
		} else {
			return false;
		}
	}
	
	/**
     * Retourne tous les fichiers dans un répertoire, y compris les fichiers dans les sous-répertoires.
     *
     * @param string $dirDest Le chemin absolu du répertoire à explorer
     * @param string $excludeDir Le nom d'un sous-répertoire à exclure
     * @return array|false Un tableau contenant tous les fichiers trouvés, ou false si aucun fichier n'a été trouvé
     */
    public static function getFiles(string $dirDest, string $excludeDir = ""): array|bool {
        $dirIterator = new RecursiveDirectoryIterator($dirDest);
        $iterator = new RecursiveIteratorIterator($dirIterator);
        $allFile = [];
		
		if (!empty($excludeDir)) {
			foreach($iterator as $file) {
				$isExclude = strpos($file->getRealpath(), $excludeDir);
				if ($file->isFile() && $isExclude === false && !in_array($file->getFilename(), array(".", "..", "index.php", "index.html"), false)) {
					$allFile[] = $file->getPathname();
				}
			}
        } else {
			foreach($iterator as $file) {
				if ($file->isFile() && !in_array($file->getFilename(), array(".", "..", "index.php", "index.html"), false)) {
					$allFile[] = $file->getPathname();
				}
			}
		}
		
        return empty($allFile) ? false : $allFile;
    }
	
    /**
     * Retourne tous les répertoires dans un répertoire, y compris les sous-répertoires, à l'exception de certains répertoires.
     *
     * @param string $dir Le chemin absolu du répertoire à explorer
     * @param string $rootFolder Le nom d'un sous-répertoire à exclure
     * @param string $excludeDir Le nom d'un sous-répertoire à exclure
     * @return array|false Un tableau contenant tous les répertoires trouvés, ou false si aucun répertoire n'a été trouvé
     */
	public static function getDirs(string $dir, string $rootFolder, string $excludeDir = ""): array|bool {
        $dirIterator = new RecursiveDirectoryIterator($dir);
        $iterator = new RecursiveIteratorIterator($dirIterator);
        $allDir = [];
		
		if (!empty($excludeDir)) {
			foreach($iterator as $file) {
				if ($file->isDir()) {
					$isRoot = strpos($file->getRealpath(), $rootFolder);
					$isExclude = strpos($file->getRealpath(), $excludeDir);
					
					if ($isRoot !== false && $isExclude === false) {
						$allDir[] = $file->getRealpath();
					}
				}
			}
		} else {
			foreach($iterator as $file) {
				if ($file->isDir()) {
					$isRoot = strpos($file->getRealpath(), $rootFolder);
					
					if ($isRoot !== false) {
						$allDir[] = $file->getRealpath();
					}
				}
			}
		}
		
        $allDir = array_unique($allDir);
        array_shift($allDir);
		
        return empty($allDir) ? false : $allDir;
    }
	
	public static function getSliceDirs(string|array $dirs, int $slice, bool $implode = false): string|array {
		if (is_array($dirs)) {
			$treeStructure = array();
			
			foreach($dirs as $dir) {
				$treeStructure[] = array_slice(explode("/", $dir), $slice);
			}
		} else {
			$treeStructure = array_slice(explode("/", $dirs), $slice);
		}
		
		if ($implode === true && !empty($treeStructure)) {
			if (is_array($dirs)) {
				$treeStructureImploded = array();
				
				foreach($treeStructure as $implodeStructure) {
					$treeStructureImploded[] = implode("/", $implodeStructure);
				}
			} else {
				$treeStructureImploded = "/". implode("/", $treeStructure);
			}
				
			return $treeStructureImploded;
		}
        return empty($treeStructure) ? false : $treeStructure;
    }
	
	public static function upload(array $file, string $targetDir, array $fileFormat = [], int $access = 1): string|array {
		set_time_limit(3600);
        
		if (!is_dir($targetDir)) {
			mkdir($targetDir, 0705, true);
		}
		
		if( is_countable($file['name']) ) {
			$fileCounter = count($file['name']);
			$filePath = array(
				'src' => array()
			);
            
			for ($i = 0; $i < $fileCounter; $i++) {
				$file['name'][$i] = self::strReplace($file['name'][$i]);
				
				$targetFile[$i] = $targetDir ."/". basename($file['name'][$i]);
				$imageFileType[$i] = strtolower(pathinfo($targetFile[$i], PATHINFO_EXTENSION));
				
				// Vérifier si le fichier existe déjà
				/* if( !empty($getFiles) ) {
					foreach($getFiles as $get_file) {
						if( basename($get_file) === basename($targetFile[$i]) ) {
							$slice_file = array_slice(explode("/", $get_file), 10);
							$message = array("Un fichier du même nom existe déjà, '/". implode('/', $slice_file) ."'", "warning");
							logs($this->session->readSession('user')['id'] ."|". $message[1] ."|". $message[0] ."|". __METHOD__ ."|". __LINE__);
							
							return $message;
						}
					}
				} */
				
				// Vérifier la taille du fichier en octets (ex: 20000o = 20Ko), (ex: 19300357o = 19.3Mo)
				if ($access > 2) {
					if ($file['size'][$i] > 10000000) {
						return array("Désolé, le fichier est trop volumineux, taille max. 10Mo", "warning");
					}
				}
				
				// Autoriser certains formats de fichiers
				if (!empty($fileFormat)) {
					if (empty(in_array($imageFileType[$i], $fileFormat))) {
						return array("Désolé, les fichiers autorisé sont de type ". implode(", ", $fileFormat) ."", "warning");
					}
				}
				
				if (move_uploaded_file($file['tmp_name'][$i], $targetFile[$i])) {
					if (!empty(in_array(mime_content_type($targetFile[$i]), self::ACCEPT_FILE_FORMAT))) {
						// Si tout va bien, essayez de télécharger le fichier
						if ($fileCounter > 1) {
							$message = array("L'enregistrement des fichiers s'est déroulé avec succès.", "success");
						} else {
							$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($file['name'][$i])) ." s'est déroulé avec succès.", "success");
						}
						$filePath['src'][] = base64_encode(substr($targetFile[$i], strpos($targetFile[$i], "/uploads")));
					} else {
						// Pas bon, on supprime le fichier
						unlink($targetFile[$i]);
						$message = array("L'enregistrement des fichiers doit être de type ". implode(", ", self::ACCEPT_FILE_FORMAT) ." !", "danger");
					}
				} else {
					if ($fileCounter > 1) {
						$message = array("L'enregistrement des fichiers ont rencontrés une erreur !", "danger");
					} else {
						$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($file['name'][$i])) ." à rencontré une erreur !", "danger");
					}
				}
				
				if( in_array($imageFileType[$i], array("jpg", "jpeg", "png", "bmp", "gif")) ) {
					$imageData = getimagesize($targetFile[$i]);
					$file['width'][$i] = $imageData[0];
					$file['height'][$i] = $imageData[1];
				} else {
					$file['width'][$i] = "";
					$file['height'][$i] = "";
				}
			}
		} else {
			$filePath = array('src' => "");
			
			$file['name'] = self::strReplace($file['name']);
			
			$targetFile = $targetDir ."/". basename($file['name']);
			$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
			
			// Vérifier si le fichier existe déjà
			/* if( !empty($getFiles) ) {
				foreach($getFiles as $get_file) {
					if( basename($get_file) === basename($targetFile) ) {
						$slice_file = array_slice(explode("/", $get_file), 10);
						$message = array("Un fichier du même nom existe déjà, '/". implode('/', $slice_file) ."'", "warning");
						logs($this->session->readSession('user')['id'] ."|". $message[1] ."|". $message[0] ."|". __METHOD__ ."|". __LINE__);
						
						return $message;
					}
				}
			} */
			
			// Vérifier la taille du fichier en octets (ex: 20000o = 20Ko), (ex: 19300357o = 19.3Mo)
			if ($access > 2) {
				if ($file['size'] > 10000000) {
					return array("Désolé, le fichier est trop volumineux, taille max. 10Mo", "warning");
				}
			}
			
			// Autoriser certains formats de fichiers
			if (!empty($fileFormat)) {
				if (empty(in_array($imageFileType, $fileFormat))) {
					return array("Désolé, les fichiers autorisé sont de type ". implode(", ", $fileFormat) ."", "warning");
				}
			}
			
			if (move_uploaded_file($file['tmp_name'], $targetFile)) {
				if (!empty(in_array(mime_content_type($targetFile), self::ACCEPT_FILE_FORMAT))) {
					// Si tout va bien, essayez de télécharger le fichier
					$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($file['name'])) ." s'est déroulé avec succès.", "success");
					$filePath['src'] = base64_encode(substr($targetFile, strpos($targetFile, "/uploads")));
				} else {
					// Pas bon, on supprime le fichier
					unlink($targetFile);
					$message = array("L'enregistrement des fichiers doit être de type ". implode(", ", self::ACCEPT_FILE_FORMAT) ." !", "danger");
				}
			} else {
				$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($file['name'])) ." à rencontré une erreur !", "danger");
			}
			
			if( in_array($imageFileType, array("jpg", "jpeg", "png", "bmp", "gif")) ) {
				$imageData = getimagesize($targetFile);
				$file['width'] = $imageData[0];
				$file['height'] = $imageData[1];
			} else {
				$file['width'] = "";
				$file['height'] = "";
			}
		}
		
		$mergeDatas = array_merge($file, $filePath, $message);
		return $mergeDatas;
    }
	
	public static function resizeLargeImage(array $files, string $sourceDir, string $targetDir, int $width, int $quality = 100): ?bool {
		foreach ($files as $file) {
			$sourcePath = $sourceDir . '/' . $file;
			$targetPath = $targetDir . '/' . $file;
			
			$imageData = file_get_contents($sourcePath);
			$info = getimagesize($sourcePath);
			
			$image = imagecreatefromstring($imageData);
			
			if ($image !== false) {
				// Calculer les dimensions proportionnelles
				$originalWidth = $info[0];
				$originalHeight = $info[1];
				
				$ratio = $width / $originalWidth;
				$height = intval($ratio * $originalHeight);
				
				$resizedImage = imagecreatetruecolor($width, $height);
				imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
				
				imagejpeg($resizedImage, $targetPath, $quality);
				
				imagedestroy($image);
				imagedestroy($resizedImage);
			}
		}
		
		return true;
	}
	
	public static function resizeImages(array $files, string $sourceDir, string $targetDir, int $width, int $quality = 100): bool {
		foreach ($files as $file) {
			$imagePath = $sourceDir .'/'. $file;
			
			if (!file_exists($imagePath)) {
				throw new Exception("Le fichier image n'existe pas : ". $file);
			}
			
			$info = getimagesize($imagePath);
			
			if (!$info) {
				throw new Exception("Le fichier image est corrompu ou n'est pas une image : ". $file);
			}
			
			$mime = $info['mime'];
			$type = strtolower(substr($mime, strpos($mime, '/') + 1));
			
			if (!in_array($type, array('jpeg', 'jpg', 'png'))) {
				throw new Exception("Le format de fichier image n'est pas supporté : ". $file);
			}
			
			// Calculer les nouvelles dimensions de l'image en conservant le ratio
			$oldWidth = $info[0];
			$oldHeight = $info[1];
			
			$ratio = $width / $oldWidth;
			$newWidth = $width;
			$newHeight = intval($ratio * $oldHeight);
			
			if ($oldWidth > 9000 || $oldHeight > 9000) {
				throw new Exception("Le fichier image est trop grande : ". $oldWidth ."x". $oldHeight);
				return false;
			}
			
			switch ($type) {
				case 'jpg':
				case 'jpeg':
					$source = imagecreatefromjpeg($imagePath);
					break;
				case 'png':
					$source = imagecreatefrompng($imagePath);
					break;
			}
			
			$outputImage = imagecreatetruecolor($newWidth, $newHeight);
            
			if (imagecopyresampled($outputImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight)) {
				if (!is_dir($targetDir)) {
					mkdir($targetDir, 0777, true);
				}
				
				switch ($type) {
					case 'jpg':
					case 'jpeg':
						imagejpeg($outputImage, $targetDir .'/'. $file, $quality);
						break;
					case 'png':
						imagepng($outputImage, $targetDir .'/'. $file, $quality / 100);
						break;
				}
			} else {
				throw new Exception("Impossible de redimensionner l'image : ". $file);
			}
			
			imagedestroy($source);
			imagedestroy($outputImage);
		}
		
		return true;
	}
	
	/**
	 * Renomme un fichier ou un répertoire.
	 *
	 * @param string $oldname L'ancien nom du fichier ou du répertoire.
	 * @param string $newname Le nouveau nom du fichier ou du répertoire.
	 * @param array $options Un tableau d'options facultatives de traitement de masse.
	 *        - 'ignore_errors': Ignorer les erreurs lors du traitement des fichiers (booléen).
	 *        - 'ignore_warnings': Ignorer les avertissements lors du traitement des fichiers (booléen).
	 * @return bool Retourne TRUE en cas de succès ou FALSE en cas d'échec.
	 */
	public static function renamer(string|array $oldname, string $newname, array $totalFiles = [], string $rootFolder = "", string $root = ""): array {
		$newname = self::strReplace(trim($newname));
		$fileNameExist = array();
		$errorRename = array();
		
		if( is_array($oldname) ) {
			if( !empty($oldname['file']) ) {
				$fileRename = $oldname['file'];
				$fileCounter = count($oldname['file']);
				
				if( isset($oldname['file_path']) && !empty($oldname['file_path']) ) {
					$renameFolder = "/". $oldname['file_path'];
				} else {
					$renameFolder = "";
				}
				
				$pathFolder = $rootFolder . $renameFolder ."/";
				$pathThumbFolder = $rootFolder ."/thumbnails". $renameFolder ."/";
				
				for( $i = 0; $i < $fileCounter; $i++ ) {
					if( $fileRename[$i] === "on" ) {continue;}
					
					$pathInfo = strtolower(pathinfo($pathFolder . $fileRename[$i], PATHINFO_EXTENSION));
					$newFileName = $newname ."-". $i .".". $pathInfo;
					$fileOldname = $renameFolder ."/". $fileRename[$i];
					$fileNewname = $renameFolder ."/". $newFileName;
					
					if( $fileOldname != $fileNewname ) {
						if( !empty($totalFiles) ) {
							foreach($totalFiles as $getFile) {
								if( basename($getFile) === basename($fileNewname) ) {
									$fileNameExist[] = $fileRename[$i];
									$continue = true;
								}
							}
						}
						if( isset($continue) ) {
							unset($continue);
							continue;
						} else {
							$success = rename($pathFolder . $fileRename[$i], $pathFolder . $newFileName);
                            
							if( file_exists($pathThumbFolder . $fileRename[$i]) ) {
								rename($pathThumbFolder . $fileRename[$i], $pathThumbFolder . $newFileName);
							}
							
							if (!$success) {
								$errorRename[] = $fileRename[$i];
							}
						}
					} elseif( $fileOldname == $fileNewname ) {
						$fileNameExist[] = $fileRename[$i];
						continue;
					}
				}
				
				$successMessage = "Les fichiers ont bien été renomé.";
				$successType = "success";
				
				if( !empty($fileNameExist) ) {
					$successMessage .= " Sauf les fichiers suivants : ". implode(", ", $fileNameExist) .".";
					$successType = "warning";
				}
				
				if( !empty($errorRename) ) {
					$successMessage .= " Une erreur s'est produite lors du renommage sur : ". implode(", ", $errorRename);
					$successType = "danger";
				}
			}
			
			if( !empty($oldname['dir']) ) {
				$dirRename = $oldname['dir'];
				$dirCounter = count($oldname['dir']);
				
				if( isset($oldname['file_path']) && !empty($oldname['file_path']) ) {
					$renameFolder = "/". $oldname['file_path'];
				} else {
					$renameFolder = "";
				}
				
				$pathFolder = $rootFolder . $renameFolder ."/";
				
				for( $i = 0; $i < $dirCounter; $i++ ) {
					if( $dirRename[$i] === "on" ) {continue;}
					
					$success = rename($pathFolder . $dirRename[$i], $pathFolder . $newname ."-". $i);
					
					if( is_dir($rootFolder ."/thumbnails". $renameFolder ."/". $dirRename[$i]) ) {
						$pathThumbFolder = $rootFolder ."/thumbnails". $renameFolder ."/";
						rename($pathThumbFolder . $dirRename[$i], $pathThumbFolder . $newname ."-". $i);
					}
					
					if (!$success) {
						$errorRename[] = $dirRename[$i];
					}
				}
				
				$successMessage = "Les dossiers ont bien été renomé.";
				$successType = "success";
			}
			
			if( !empty($oldname['dir']) && !empty($oldname['file']) ) {
				if( !empty($fileNameExist) ) {
					return array("Les dossiers et fichiers ont bien été renomé. Sauf les fichiers suivants : ". implode(", ", $fileNameExist), "warning");
				} else {
					return array("Les dossiers et fichiers ont bien été renomé.", "success");
				}
			} else {
				return array($successMessage, $successType);
			}
		} else {
			$message = array("L'élément sélectionné n’est ni un fichier ni un dossier.", "danger");
			$explodeRootFolder = explode("/", $rootFolder);
			
			if (is_file($oldname)) {
				$pathInfo = strtolower(pathinfo($oldname, PATHINFO_EXTENSION));
				
				$explodeOldPathname = explode("/", $oldname);
				$fileOldName = end($explodeOldPathname);
				array_pop($explodeOldPathname);
				
				$fileNewName = $newname .".". $pathInfo;
				$newname = implode("/", $explodeOldPathname) ."/". $fileNewName;
				
				$arrayDiff = array_diff($explodeOldPathname, $explodeRootFolder);
				$thumbOldName = $rootFolder ."/thumbnails/". implode("/", $arrayDiff) ."/". $fileOldName;
				$thumbNewName = $rootFolder ."/thumbnails/". implode("/", $arrayDiff) ."/". $fileNewName;
				
				foreach($totalFiles as $getFile) {
					if (basename($getFile) === basename($newname)) {
						$sliceFile = array_slice(explode("/", $getFile), 10);
                        
						return array("Un fichier du même nom existe déjà, '/". implode("/", $sliceFile) ."'", "warning");
					}
				}
				
				$success = rename($oldname, $newname);
                
				if( file_exists($thumbOldName) ) {
					rename($thumbOldName, $thumbNewName);
				}
				
				if ($success) {
					$message = array("Le fichier <strong>'". $fileOldName ."'</strong> à bien été renommé en <strong>'". $fileNewName ."'</strong>", "success");
				} else {
					$message = array("Erreur lors du renommage du fichier", "danger");
				}
			} elseif (is_dir($oldname)) {
				$explodeOldPathname = explode("/", $oldname);
				$dirOldName = end($explodeOldPathname);
				array_pop($explodeOldPathname);
				
				$dirNewName = $newname;
				$newname = implode("/", $explodeOldPathname) ."/". $newname;
				
				$arrayDiff = array_diff($explodeOldPathname, $explodeRootFolder);
				$thumbOldName = $rootFolder ."/thumbnails/". implode("/", $arrayDiff) ."/". $dirOldName;
				$thumbNewName = $rootFolder ."/thumbnails/". implode("/", $arrayDiff) ."/". $dirNewName;
				
				$success = rename($oldname, $newname);
				
				if( is_dir($thumbOldName) ) {
					rename($thumbOldName, $thumbNewName);
				}
				
				if ($success) {
					$message = array("Le dossier <strong>'". $dirOldName ."'</strong> à bien été renommé en <strong>'". $dirNewName ."'</strong>", "success");
				} else {
					$message = array("Erreur lors du renommage du dossier", "danger");
				}
			}
			
			return $message;
		}
	}
	
	/**
	 * Cette fonction permet de déplacer des fichiers ou des dossiers
	 * 
	 * @param string|array $oldPath - le chemin d'origine du fichier ou dossier à déplacer
	 * @param string $newPath - le chemin de destination
	 * @param string $rootFolder - le dossier personnel de l'utilisateur
	 * @param array $moveFiles - les fichiers ou dossiers à déplacer (optionnel)
	 * @return array - un tableau contenant un message, un type de message et éventuellement un type de fichier (dossier ou fichier)
	 */
	public static function move(string|array $oldPath, string $newPath, string $rootFolder, array $moveFiles = []) {
		$dirDest = explode("/", $newPath);
		array_pop($dirDest);
		$dirDest = implode("/", $dirDest) ."/";
        
		if( !empty($moveFiles) ) { // Si on a des fichiers ou dossiers à déplacer
			$errorTransfert = array(); // On initialise un tableau d'erreur de transfert
			$rootOldPath = $rootFolder . $oldPath ."/"; // On crée le chemin complet de l'ancien dossier ou fichier
			$rootNewPath = $rootFolder . $newPath ."/"; // On crée le chemin complet du nouveau dossier ou fichier
			
			// Si on a des dossiers à déplacer
			if( isset($moveFiles['dir']) ) {
				foreach($moveFiles['dir'] as $movingDir) {
					$moveOldFiles[] = $rootOldPath . $movingDir; // On ajoute le chemin complet de l'ancien dossier dans un tableau
					$moveNewFiles[] = $rootNewPath . $movingDir; // On ajoute le chemin complet du nouveau dossier dans un tableau
				}
			}
			
			// Si on a des fichiers à déplacer
			if( isset($moveFiles['file']) ) {
				foreach($moveFiles['file'] as $movingFile) {
					if( $movingFile != "on" ) { // Si on ne veut pas déplacer tous les fichiers
						$moveOldFiles[] = $rootOldPath . $movingFile; // On ajoute le chemin complet de l'ancien fichier dans un tableau
						$moveNewFiles[] = $rootNewPath . $movingFile; // On ajoute le chemin complet du nouveau fichier dans un tableau
					}
				}
			}
			
			// Si le nombre de fichiers ou dossiers à déplacer est le même dans les deux tableaux, on peut commencer à déplacer
			if( count($moveOldFiles) == count($moveNewFiles) ) {
				for($i = 0; $i < count($moveOldFiles); $i++ ) {
					$moveOldThumbpath = str_replace($rootFolder, $rootFolder ."/thumbnails", $moveOldFiles[$i]);
					$moveNewThumbpath = str_replace($rootFolder, $rootFolder ."/thumbnails", $moveNewFiles[$i]);
					
					if (rename($moveOldFiles[$i], $moveNewFiles[$i])) {
						if (is_dir($moveOldThumbpath) || file_exists($moveOldThumbpath)) {
							rename($moveOldThumbpath, $moveNewThumbpath);
						}
						$message = "Les dossiers / fichiers ont bien été déplacer dans le dossier <strong>'". basename($newPath) ."'</strong>.";
						$successType = "success";
					} else {
						// On ajoute le nom du fichier ou dossier ayant causé une erreur de transfert dans un tableau d'erreur
						$errorTransfert[] = basename($oldPath);
					}
				}
				
				if( !empty($errorTransfert) ) {
					$message .= " Sauf les fichiers suivants : ". implode(", ", $errorTransfert) .".";
					$successType = "warning";
				}
				
				return array($message, $successType);
			} else {
				return array("les transferts ont échoué !", "warning");
			}
		} else {
			if (is_dir($dirDest)) {
				$fileOldpath = basename($oldPath);
				$oldThumbpath = str_replace($rootFolder, $rootFolder ."/thumbnails", $oldPath);
				$newThumbpath = str_replace($rootFolder, $rootFolder ."/thumbnails", $newPath);
				
				// Récupérer le nom de base du nouveau chemin
				if( basename($dirDest) === $rootFolder ) {
					$fileNewpath = "racine";
				} else {
					$fileNewpath = basename($dirDest);
				}
				
				// Déplacez le fichier ou le répertoire vers le nouveau chemin
				$fileTypeLabel = is_file($oldPath) ? "fichier" : "dossier";
				
				// Détermine le type de fichier en fonction du chemin
				$fileType = is_file($oldPath) ? "file" : "folder";
				
				// Tente de déplacer le fichier ou le répertoire
				if (rename($oldPath, $newPath)) {
					if (is_dir($oldThumbpath) || file_exists($oldThumbpath)) {
						rename($oldThumbpath, $newThumbpath);
					}
                    
					$message = array("Le ". $fileTypeLabel ." <strong>'". $fileOldpath ."'</strong> a bien été déplacé dans le dossier <strong>'". $fileNewpath ."'</strong>", "success", $fileType);
				} else {
					$message = array("Erreur lors du déplacement du ". $fileTypeLabel ." <strong>'". $fileOldpath ."'</strong> dans le dossier <strong>'". $fileNewpath ."'</strong>", "danger", $fileType);
				}
			} else {
				$message = array("Le chemin de destination n'est pas un dossier valide", "warning", "");
			}
		}
		
		return $message;
	}
	
	/**
	 * Supprime un fichier ou un dossier.
	 * 
	 * @param string $path Chemin relatif du dossier qui contient le(s) fichier(s)/dossier(s) à supprimer
	 * @param string|array $file Nom du fichier/dossier à supprimer ou tableau associatif contenant les fichiers/dossiers à supprimer
	 * @param string $type Type de fichier/dossier à supprimer ('file' pour un fichier, 'dir' pour un dossier, ou vide si $file est un tableau associatif contenant les fichiers/dossiers)
	 * @param string $rootFolder Chemin absolu du dossier racine à partir duquel le fichier/dossier doit être supprimé
	 * @param array &$fileDeleted Tableau de référence pour stocker les noms de fichiers supprimés
	 * @param array &$dirDeleted Tableau de référence pour stocker les noms de dossiers supprimés
	 * @return array Tableau contenant le message de succès ou d'erreur ainsi que le type de succès ou d'erreur
	 */
	public static function remove(string $path, string|array $file, string $type, string $rootFolder, array &$fileDeleted = [], array &$dirDeleted = []): array {
		if ($type === 'file') {
			$targetFile = $rootFolder . $path ."/". $file;
			$targetThumbFile = $rootFolder ."/thumbnails". $path ."/". $file;
			
			if ($file != "index.php") {
				$fileDeleted[] = $file;
			}
			
			unlink($targetFile);
			
			if (file_exists($targetThumbFile)) {
				unlink($targetThumbFile);
			}
		} elseif ($type === 'dir') {
			$pathFolder = $path ."/". $file;
			$targetFolder = $rootFolder . $path ."/". $file;
			$targetThumbFolder = $rootFolder ."/thumbnails". $path ."/". $file;
			$dirDeleted[] = $file;
			
			$files = array_diff(scandir($targetFolder), array('.', '..'));
			
			foreach ($files as $fileName) {
                $fileType = is_file($targetFolder ."/". $fileName) ? 'file' : 'dir';
				self::remove($pathFolder, $fileName, $fileType, $rootFolder, $fileDeleted, $dirDeleted);
			}
			
			rmdir($targetFolder);
			
			if (is_dir($targetThumbFolder)) {
				rmdir($targetThumbFolder);
			}
		} elseif (is_array($file)) {
			// Si c'est un tableau, on supprime tous les fichiers/dossiers contenus dans le tableau
			foreach ($file as $type => $files) {
				foreach ($files as $f) {
					if ($f == "on") {continue;}
					self::remove($path, $f, $type, $rootFolder, $fileDeleted, $dirDeleted);
				}
			}
		} else {
			$message = "Le paramètre $type doit être 'file', 'dir' ou $file un tableau";
			$successType = "danger";
		}
		
		$message = "La suppression à réussi.";
		$successType = "success";
		
		if (!empty($fileDeleted)) {
			$message .= "<br /><span><strong>Fichiers supprimés :</strong></span> <span>". implode("</span> | <span>", $fileDeleted) ."</span>";
		}
		if (!empty($dirDeleted)) {
			$message .= "<br /><span><strong>Dossiers supprimés :</strong></span> <span>". implode("</span> | <span>", $dirDeleted) ."</span>";
		}
		
		return array($message, $successType);
    }
	
	/**
	 * Crée un dossier dans un répertoire personnel avec un message de retour
	 *
	 * @param string $folderName Le nom du dossier à créer
	 * @param string $rootFolder Le chemin du répertoire personnel
	 * @return array Un tableau avec le message de retour et le type de message
	 */
    public static function createDir(string $folderName, string $rootFolder, bool $addThumbsDir = true): array {
		$folderName = self::strReplace(trim($folderName));
		
		if ($folderName[0] === '/') {
			$folderName = substr($folderName, 1);
			// debug($folderName);
		}
		
		// Trouve la position du premier slash "/" dans le nom du dossier
		$slashFinded = strpos($folderName, "/", 1);
		
		$targetDir = $rootFolder ."/". $folderName;
		$targetThumbDir = $rootFolder ."/thumbnails/". $folderName;
		
		if (!is_dir($targetDir)) {
			if (mkdir($targetDir, 0705, true)) {
				if ($addThumbsDir == true) {
					mkdir($targetThumbDir, 0705, true);
				}
				// Ajoute un fichier index.php dans le répertoire personnel
				self::addFile($rootFolder);
				
				// Si le nom du dossier ne contient pas de slash "/", ajoute un fichier index.php dans le dossier créé
				if (!$slashFinded) {
					self::addFile($targetDir);
				} else {
					// Si le nom du dossier contient un ou plusieurs slash "/", ajoute un fichier index.php dans chaque sous-répertoire créé
					$folderArrayName = array_filter(explode("/", $folderName));
					$targetArrayDir = $rootFolder;
					
					foreach($folderArrayName as $folder) {
						// Ajout du nom du sous-dossier au chemin du dossier cible
						$targetArrayDir .= "/". trim($folder);
						
						// Ajout d'un fichier index.php au sous-dossier cible
						self::addFile($targetArrayDir);
					}
				}
				$message = array("Le dossier ". basename($folderName) ." a été créé avec succès", "success");
			} else {
				$message = array("Le dossier ". basename($folderName) ." n'a pas pu être créé !", "danger");
			}
		} else {
			$message = array("Le dossier ". basename($folderName) ." existe déjà !", "warning");
		}
		
		return $message;
    }
	
    /**
     * Récupère la taille d'un tableau de fichiers en octets.
     * 
     * @param array $files Les fichiers dont on veut récupérer la taille.
     * @return int La taille des fichiers en octets.
     */
    public static function getFilesSize(array $files): int {
		$total_file_size = 0;
		
		foreach($files as $size) {
			$total_file_size = $total_file_size + filesize($size);
		}
		
		return $total_file_size;
	}
	
    /**
     * Récupère la taille d'un fichier en octets.
     * 
     * @param string $file Le fichier dont on veut récupérer la taille.
     * @return int La taille du fichier en octets.
     */
    public static function getFileSize(string $file): int {
        return filesize($file);
    }
	
    /**
     * Récupère la taille d'un fichier en octets.
     * 
     * @param string $file Le fichier dont on veut récupérer la taille.
     * @return int La taille du fichier en octets.
     */
	public static function addFile(string $path, string $fileName = "index.php"): void {
		if (!file_exists($path ."/". $fileName)) {
			$newFile = fopen($path ."/". $fileName, 'x');
			fclose($newFile);
		}
	}
	
    /**
     * Récupère la taille d'un fichier en octets.
     * 
     * @param string $file Le fichier dont on veut récupérer la taille.
     * @return int La taille du fichier en octets.
     */
	public static function strReplace(string $string): string {
		$search  = array(
			"à", "â", "ä", "ã", "æ", "å", "ā", "ă", "ą", "á", 
			"ç", 
			"é", "è", "ê", "ë", "ē", "ė", "ę", "ě", "ĕ", "ə", 
			"í", "ì", "î", "ï", "ī", "į", "ı", 
			"ñ", 
			"ó", "ò", "ô", "ö", "ø", "õ", "ō", "ő", "œ", 
			"ú", "ù", "û", "ü", "ū", "ů", "ű", "ų", 
			"ÿ", "ý", 
			"’", " (", ") ", " (", ") ", " -", "- ", " - ", " ( ", " ) ", " /", "/ ", " / ", "_", " ", "'", "!", "@", "#", "£", "¥", "₩", "€", "+", "×", "÷", "=", "$", "%", "^", "&", "(", ")", "{", "}", "[", "]", "°", "•", ";", ",", "`", "~", "○", "●", "□", "■", "♤", "♡", "◇", "♧", "☆", "▪", "¤", "《", "》", "¡", "¿", "*", "\""
		);
		$replace = array(
			"a", "a", "a", "a", "a", "a", "a", "a", "a", "a", 
			"c", 
			"e", "e", "e", "e", "e", "e", "e", "e", "e", "e", 
			"i", "i", "i", "i", "i", "i", "i", 
			"n", 
			"o", "o", "o", "o", "o", "o", "o", "o", "o", 
			"u", "u", "u", "u", "u", "u", "u", "u", 
			"y", "y", 
			"-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-"
		);
        
		return str_replace("-.", ".", strtolower(str_replace($search, $replace, $string)));
	}
	
}

?>