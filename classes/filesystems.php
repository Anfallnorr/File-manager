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
	// $extensions = array('doc_src' => array("doc","docx","odf","odp","ods","odt","otf","pdf","ppt","csv","pps","pptx","xls","xlsx","rtf","txt"));
	// $extensions = array('audio_src' => array("mp3","wav","wave","wma","aac","mid","midi","ogg"));
	// $extensions = array('img_src' => array("jpg","jpeg","png","tif","webp","bmp","ico","svg","gif"));
	// $extensions = array('vid_src' => array("mp4","mpg","mpeg","mov","3gp","avi"));
	// $extensions = array('other_src' => array("apk","exe","msi","html","css","js","sql","psd","raw","xcf","ai","aif","dxf","zip","7z"));
	
    protected $unite;
    // protected $basePath;
    protected $path;
    private $requests;
	
    public function __construct($basePath, object $requests = new stdClass) {
        $this->unite = array("Octets","Ko","Mo","Go");
        $this->path = $basePath;
        $this->requests = $requests;
    }
	
	// La fonction getContents() récupère les fichiers et répertoires contenus dans le répertoire spécifié par 
	// l'instance de la classe Directory. Elle retourne un tableau associatif contenant les informations sur les 
	// fichiers et répertoires trouvés, trié ou non selon le paramètre $sortByDate.
	
	// Si $sortByDate est défini sur true, la fonction trie les résultats par date de modification décroissante, 
	// sinon les résultats sont renvoyés dans l'ordre dans lequel ils ont été trouvés. Les informations récupérées 
	// pour chaque élément sont :
	
	// name : le nom du fichier ou du répertoire
	// date : la date de modification du fichier ou du répertoire
	// size : la taille du fichier en octets (pour les fichiers seulement)
	// extension : l'extension de fichier (pour les fichiers seulement)
	// path : le chemin d'accès complet à l'élément, relatif au répertoire racine.
	
	// La fonction ignore les fichiers et répertoires cachés (dont le nom commence par un point) et retourne 
	// un tableau vide si aucun élément n'a été trouvé dans le répertoire.
	/**
	 * Récupère les fichiers et répertoires contenus dans le répertoire spécifié,
	 * avec des informations sur leur nom, date de modification, taille et extension de fichier le cas échéant.
	 * Si $sortByDate est défini sur true, trie les résultats par date de modification décroissante.
     * 
	 * @param bool $sortByDate (facultatif) Indique si les résultats doivent être triés par date de modification décroissante. Défaut à false.
	 * @return array Tableau associatif contenant les informations sur les fichiers et répertoires trouvés, trié ou non selon $sortByDate.
	 */
    function getContents($sortByDate = false) {
		debug("function getContents(false)", true);
		// Récupère le contenu du répertoire
        $contents = scandir($this->path);
		// Tableau pour stocker les dossiers
        $files = array();
		// Tableau pour stocker les fichiers
        $directories = array();
		// debug();
		// Parcours le contenu
        foreach ($contents as $content) {
			// Ignore les répertoires "." et ".."
            if ($content == "." || $content == "..") {
                continue;
            }
			
			// debug($content);
			// debug($this->path);
			// Si le contenu est un dossier
            if (is_dir($this->path . "/" . $content)) {
				// Ajoute le dossier au tableau de dossiers avec son nom, date de modification, et son chemin
                $directories[] = array(
                    "name" => $content,
                    "date" => filemtime($this->path . "/" . $content),
                    "size" => 0,
                    "extension" => "",
                    // "path" => $this->requests->buildPath($content)
                );
            } else {
				// Sinon, si le contenu est un fichier, ajoute le fichier au tableau de fichiers avec son nom, date de modification, sa taille, son extension, et son chemin
                $files[] = array(
                    "name" => $content,
                    "date" => filemtime($this->path . "/" . $content),
                    "size" => filesize($this->path . "/" . $content),
                    "extension" => pathinfo($this->path . "/" . $content, PATHINFO_EXTENSION),
                    // "path" => $this->requests->buildPath($content)
                );
            }
        }
		
		// Si l'option de tri par date est activée
        if ($sortByDate) {
			// Trie le tableau de dossiers par date de modification décroissante
            usort($directories, function($a, $b) {
                return $b["date"] - $a["date"];
            });
			// Trie le tableau de fichiers par date de modification décroissante
            usort($files, function($a, $b) {
                return $b["date"] - $a["date"];
            });
        }
		
		// Fusionne les tableaux de dossiers et de fichiers et retourne le résultat
        return array_merge($directories, $files);
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
		// Initialisation du tableau des catégories de fichiers avec les tableaux vides pour chaque catégorie
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
		
		// Boucle sur chaque fichier dans le tableau des fichiers
		foreach ($files as $file) {
			// Obtention de l'extension du fichier
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			// Variable pour savoir si le fichier est catégorisé
			$categorized = false;
			
			// Boucle sur chaque catégorie de fichiers
			foreach ($categories as $type => $category) {
				// Si l'extension du fichier est dans la liste des extensions pour cette catégorie
				if (in_array($ext, self::getExtByType($type))) {
					// Ajout du fichier dans la catégorie correspondante
					$categories[$type]['src'][] = $file;
					
					// Ajout du nom de fichier dans la catégorie correspondante si demandé
					if ($basename == true) {
						$categories[$type]['basename'][] = basename($file);
					}
					
					// Ajout du dossier parent dans la catégorie correspondante si demandé
					if ($path == true) {
						$categories[$type]['path'][] = self::getExtractedFolder($file);
					}
					
					// Le fichier est catégorisé, on sort de la boucle
					$categorized = true;
					break;
				}
			}
			
			// Si le fichier n'a pas été catégorisé, on l'ajoute dans la catégorie "other"
			if (!$categorized) {
				// Ajout du fichier dans la catégorie "other"
				$categories['other']['src'][] = $file;
				
				// Ajout du nom de fichier dans la catégorie "other" si demandé
				if ($basename == true) {
					$categories['other']['basename'][] = basename($file);
				}
				
				// Ajout du dossier parent dans la catégorie "other" si demandé
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
		// $folder = "/folder1/folder2/folder3/folder4/folder5/folder5/uploads/datas/personnal-folder-dynamique/toto/titi/tete/gros-minet/10-styles-of-metal.mp4";
		// $folder = "/folder1/folder2/folder3/folder4/folder5/folder5/uploads/datas/personnal-folder-dynamique/videos/musiques/toto/10-styles-of-metal.mp4";
		// $uploads_datas = "/uploads/datas/";
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
	
	/* public static function getPersonalDriveTotal($folder) {
		$personalDriveTotal = array();
		// $dir = _ROOTURL_ . '/uploads/datas/' . $folder;
		// if (is_dir($dir)) {
		if (is_dir($folder)) {
			$files = self::getFiles($folder);
			$personalDriveTotal = self::categorizeFiles($files);
			// debug($personalDriveTotal, true);
		}
		return $personalDriveTotal;
	} */
	
	/**
	 * Récupère les extensions de fichier associées à un type donné.
	 * 
	 * @param string $type Le type de fichier pour lequel récupérer les extensions.
	 * @return array Les extensions de fichier associées au type spécifié, ou un tableau vide si le type n'existe pas.
	 */
	public static function getExtByType(string $type): array {
		// debug($type);
		// debug(self::EXTENSIONS[$type]);
		// die;
		if (array_key_exists($type, self::EXTENSIONS)) {
			return self::EXTENSIONS[$type];
		}
		return array();
		// return self::EXTENSIONS[$type];
	}
	
    /**
     * Parcours un répertoire de manière récursive et renvoie un tableau de tous les fichiers contenus dans ce répertoire et ses sous-répertoires.
     * 
     * @param string $dir Le répertoire à parcourir
     * @return array Un tableau contenant tous les fichiers contenus dans le répertoire et ses sous-répertoires.
     */
    /* public static function getFilesRecursively(string $dir): array {
        $files = array();
		
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
            RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore les erreurs "Permission denied"
        );
		
        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $files[] = $file->getPathname();
            }
        }
		
        return $files;
    } */
	
    /**
     * Supprime un fichier ou un répertoire de manière récursive.
     * 
     * @param string $path Le chemin du fichier ou du répertoire à supprimer.
     * @return bool Vrai si le fichier ou le répertoire a été supprimé, faux sinon.
     */
    /* public static function deleteRecursively(string $path): bool {
        if (!file_exists($path)) {
            return false;
        }
		
        if (is_dir($path)) {
            $iterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);
			
            foreach ($files as $file) {
                if ($file->isDir()) {
                    rmdir($file->getPathname());
                } else {
                    unlink($file->getPathname());
                }
            }
			
            rmdir($path);
        } else {
            unlink($path);
        }
		
        return true;
    } */
  
    public static function getSize(string|array $files, int $totalFileSize = 0): int|float {
		// $totalFileSize = 0;
		
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
		// debug($size);324998864
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
	// Ces fonctions peuvent être appelées de la manière suivante :
	// $all_files = FileSystems::getFiles('/path/to/directory');
    public static function getFiles(string $dirDest, string $excludeDir = ""): array|bool {
        $dirIterator = new RecursiveDirectoryIterator($dirDest);
        $iterator = new RecursiveIteratorIterator($dirIterator);
        $allFile = [];
		// debug($excludeDir);
		
		if (!empty($excludeDir)) {
			foreach($iterator as $file) {
				$isExclude = strpos($file->getRealpath(), $excludeDir);
				// if ($file->isFile() && $file->getFilename() != "." && $file->getFilename() != ".." && $file->getFilename() != "index.php") {
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
		
		// debug($allFile);
		// die;
		
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
	// Ces fonctions peuvent être appelées de la manière suivante :
	// $all_directories = FileSystems::getAllDirectories('/path/to/directory', 'excluded_directory');
	public static function getDirs(string $dir, string $rootFolder, string $excludeDir = ""): array|bool {
        $dirIterator = new RecursiveDirectoryIterator($dir);
        $iterator = new RecursiveIteratorIterator($dirIterator);
        $allDir = [];
		// debug($excludeDir);
		
		if (!empty($excludeDir)) {
			foreach($iterator as $file) {
				if ($file->isDir()) {
					$isRoot = strpos($file->getRealpath(), $rootFolder);
					$isExclude = strpos($file->getRealpath(), $excludeDir);
					// $isExclude = strpos($file->getRealpath(), "thumbnails");
					
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
		
		// debug($allDir);
		// die;
		
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
				// debug($treeStructureImploded, true);
			}
				
			return $treeStructureImploded;
		}
        return empty($treeStructure) ? false : $treeStructure;
        // return $treeStructure;
    }
	
	public static function upload(array $file, string $targetDir, array $fileFormat = [], int $access = 1): string|array {
		// debug($file);
		// debug($targetDir);
		// debug($fileFormat);
		// debug($access, true);
		set_time_limit(3600);
		
		// debug($targetDir);
		// die;
		
		// $file_format = $this->fileFormat();
		// $acceptFileFormat = self::ACCEPT_FILE_FORMAT;
		// $personnalFolder = $getCustomer['datas']['personnal_folder'];
		// if( is_string($file['name']) ) {
			// debug($file);
			// debug($file['name']);
		// }
		
		if (!is_dir($targetDir)) {
			mkdir($targetDir, 0705, true);
		}
		
		if( is_countable($file['name']) ) {
			$fileCounter = count($file['name']);
			$filePath = array(
				'src' => array()
			);
			// $getFiles = self::getFiles($this->config->root_path ."/uploads/datas/". $this->personnalFolder ."/");
			
			// if( !empty($file["file_path"]) ) {
				// $targetDir = $this->config->root_path ."/uploads/datas/". $this->personnalFolder ."/". $file['file_path'] ."/";
			// } else {
				// $targetDir = $this->config->root_path ."/uploads/datas/". $this->personnalFolder ."/";
			// }
			
			for ($i = 0; $i < $fileCounter; $i++) {
				$file['name'][$i] = self::strReplace($file['name'][$i]);
				
				$targetFile[$i] = $targetDir ."/". basename($file['name'][$i]);
				$imageFileType[$i] = strtolower(pathinfo($targetFile[$i], PATHINFO_EXTENSION));
				
				// debug($file);
				// debug($targetDir);
				// debug($targetFile[$i]);
				// debug(strtolower(substr($targetFile[$i], strpos("/uploads/datas", '/') + 1)));
				// debug(substr($targetFile[$i], strpos($targetFile[$i], "/uploads")));
				// debug($imageFileType[$i]);
				// die;
				
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
					// Si tout va bien, on vérifie le type mime du fichier
					if (!empty(in_array(mime_content_type($targetFile[$i]), self::ACCEPT_FILE_FORMAT))) {
						// Si tout va bien, essayez de télécharger le fichier
						if ($fileCounter > 1) {
							$message = array("L'enregistrement des fichiers s'est déroulé avec succès.", "success");
						} else {
							$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($file['name'][$i])) ." s'est déroulé avec succès.", "success");
						}
						$filePath['src'][] = base64_encode(substr($targetFile[$i], strpos($targetFile[$i], "/uploads")));
						// if( $imageFileType[$i] == "jpg" || $imageFileType[$i] == "jpeg" || $imageFileType[$i] == "png" ) {
							// $redim['img'][] = $file['name'][$i];
						// }
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
					$file['height'][$i] = $imageData[1]; // debug($datas, true);
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
			
			// debug($file);
			// debug($targetDir);
			// debug($targetFile);
			// debug(strtolower(substr($targetFile, strpos("/uploads/datas", '/') + 1)));
			// debug(substr($targetFile, strpos($targetFile, "/uploads")));
			// debug($imageFileType);
			// die;
			
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
				// Si tout va bien, on vérifie le type mime du fichier
				if (!empty(in_array(mime_content_type($targetFile), self::ACCEPT_FILE_FORMAT))) {
					// Si tout va bien, essayez de télécharger le fichier
					$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($file['name'])) ." s'est déroulé avec succès.", "success");
					$filePath['src'] = base64_encode(substr($targetFile, strpos($targetFile, "/uploads")));
					// if( $imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png" ) {
						// $redim['img'][] = $file['name'];
					// }
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
				$file['height'] = $imageData[1]; // debug($datas, true);
			} else {
				$file['width'] = "";
				$file['height'] = "";
			}
		}
		
		$mergeDatas = array_merge($file, $filePath, $message);
		return $mergeDatas;
		// return $message;
    }
	
	/* , string $sourceDir */
	/* public static function resizeImagick(string $file, string $targetDir, int $width, int $height, int $quality): ?bool {
		// $imagePath = $sourceDir . '/' . $file;
		
		// Créer une instance d'Imagick
		$image = new \Imagick($file);
		// debug();
		// Redimensionner l'image
		$image->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1, true);
		// $image->thumbnailImage( 100, null );
		
		// Créer le chemin de destination en conservant l'arborescence de l'image source
		if (!is_dir($targetDir)) {
			mkdir($targetDir, 0777, true);
		}
		
		// Enregistrer l'image redimensionnée
		$image->setImageCompressionQuality($quality);
		$image->writeImage($targetDir ."/". basename($file));
		
		// Libérer la mémoire
		$image->clear();
		$image->destroy();
		
		return true;
	} */
	
	public static function resizeLargeImage(array $files, string $sourceDir, string $targetDir, int $width, int $quality = 100): ?bool {
		foreach ($files as $file) {
			$sourcePath = $sourceDir . '/' . $file;
			$targetPath = $targetDir . '/' . $file;
			
			// Récupérer les données binaires de l'image
			$imageData = file_get_contents($sourcePath);
			$info = getimagesize($sourcePath);
			
			// Créer une image à partir des données binaires
			$image = imagecreatefromstring($imageData);
			
			if ($image !== false) {
				// Calculer les dimensions proportionnelles
				$originalWidth = $info[0];
				$originalHeight = $info[1];
				
				$ratio = $width / $originalWidth;
				$height = intval($ratio * $originalHeight);
				
				// Créer une nouvelle image redimensionnée
				$resizedImage = imagecreatetruecolor($width, $height);
				imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
				
				// Sauvegarder l'image redimensionnée dans le répertoire cible
				imagejpeg($resizedImage, $targetPath, $quality);
				
				// Libérer la mémoire utilisée par les images
				imagedestroy($image);
				imagedestroy($resizedImage);
			}
		}
		
		return true;
	}
	
	public static function resizeImages(array $files, string $sourceDir, string $targetDir, int $width, int $quality = 100): bool {
		foreach ($files as $file) {
			$imagePath = $sourceDir .'/'. $file;
			
			// Vérifier si le fichier image existe et peut être ouvert
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
				// self::resizeImagick($imagePath, $targetDir, $newWidth, $newHeight, $quality);
				// self::resizeImagick($imagePath, $sourceDir , $targetDir, $newWidth, $newHeight, $quality);
			}
			
			// Créer une nouvelle image en fonction du type de fichier
			switch ($type) {
				case 'jpg':
				case 'jpeg':
					$source = imagecreatefromjpeg($imagePath);
					break;
				case 'png':
					$source = imagecreatefrompng($imagePath);
					break;
			}
			
			// Redimensionner l'image
			// Création de l'image de sortie
			$outputImage = imagecreatetruecolor($newWidth, $newHeight);
			// Redimensionnement de l'image source vers l'image de sortie
			if (imagecopyresampled($outputImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight)) {
				// Créer le chemin de destination en conservant l'arborescence de l'image source
				if (!is_dir($targetDir)) {
					mkdir($targetDir, 0777, true);
				}
				
				// Enregistrer l'image redimensionnée
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
			
			// Libérer la mémoire
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
		// $newname = self::strReplace($newname);
		$newname = self::strReplace(trim($newname));
		$fileNameExist = array();
		$errorRename = array();
		
		if( is_array($oldname) ) {
			// $message = array("Une erreur s'est produite lors du renommage", "danger");
			
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
							// miniatures => thumbnails
							
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
				// $newname = implode("/", $explodeOldPathname) ."/". $newname .".". $pathInfo;
				$newname = implode("/", $explodeOldPathname) ."/". $fileNewName;
				
				$arrayDiff = array_diff($explodeOldPathname, $explodeRootFolder);
				$thumbOldName = $rootFolder ."/thumbnails/". implode("/", $arrayDiff) ."/". $fileOldName;
				$thumbNewName = $rootFolder ."/thumbnails/". implode("/", $arrayDiff) ."/". $fileNewName;
				
				foreach($totalFiles as $getFile) {
					if (basename($getFile) === basename($newname)) {
						$sliceFile = array_slice(explode("/", $getFile), 10);
						// $message = array("Un fichier du même nom existe déjà, '/". implode("/", $sliceFile) ."'", "warning");
						
						// return $message;
						return array("Un fichier du même nom existe déjà, '/". implode("/", $sliceFile) ."'", "warning");
					}
				}
				
				$success = rename($oldname, $newname);
				// miniatures => thumbnails
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
				
				// debug($arrayDiff);
				// debug($thumbOldName);
				// debug($thumbNewName);
				// debug($dirOldName);
				// debug($newname);
				// die;
				
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
		// On récupère le dossier de destination en enlevant le nom du fichier de la variable $newPath
		// $dirDest = str_replace(basename($newPath), "", $newPath);
		$dirDest = explode("/", $newPath);
		array_pop($dirDest);
		$dirDest = implode("/", $dirDest) ."/";
		// $dirDest3 = substr($newPath, 0, -(basename($newPath)));
		// $dirMinDest = str_replace($rootFolder, $rootFolder ."/thumbnails", $dirDest);
		
		// debug(basename($newPath));
		// debug($newPath);
		// debug($newPath);
		// debug($dirDest);
		// debug($dirDest2);
		// debug(count(basename($newPath)));
		// die;
		
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
				// Boucle à travers les fichiers à déplacer et les déplace un par un
				for($i = 0; $i < count($moveOldFiles); $i++ ) {
					$moveOldThumbpath = str_replace($rootFolder, $rootFolder ."/thumbnails", $moveOldFiles[$i]);
					$moveNewThumbpath = str_replace($rootFolder, $rootFolder ."/thumbnails", $moveNewFiles[$i]);
					
					// Si le déplacement s'est bien passé
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
				
				// Si des erreurs se sont produites lors du déplacement de certains fichiers
				if( !empty($errorTransfert) ) {
					$message .= " Sauf les fichiers suivants : ". implode(", ", $errorTransfert) .".";
					$successType = "warning";
				}
				
				// Retourne un tableau contenant un message et le type de succès
				return array($message, $successType);
			} else {
				// Retourne un tableau contenant un message et le type de succès
				return array("les transferts ont échoué !", "warning");
			}
		} else {
			// Vérifiez si le nouveau chemin est un répertoire
			if (is_dir($dirDest)) {
				// Récupérer le nom de base de l'ancien chemin
				$fileOldpath = basename($oldPath);
				$oldThumbpath = str_replace($rootFolder, $rootFolder ."/thumbnails", $oldPath);
				$newThumbpath = str_replace($rootFolder, $rootFolder ."/thumbnails", $newPath);
				
				// Récupérer le nom de base du nouveau chemin
				if( basename($dirDest) === $rootFolder ) {
					// Si le dossier de destination est le dossier personnel de l'utilisateur, alors le nouveau chemin est "racine"
					$fileNewpath = "racine";
				} else {
					// Sinon, le nouveau chemin est le nom du dossier de destination
					$fileNewpath = basename($dirDest);
				}
				
				// Ajouter l'ancien nom de base au nouveau chemin
				// $newPath = rtrim($newPath, '/') . '/' . $fileOldpath;
				
				// Déplacez le fichier ou le répertoire vers le nouveau chemin
				$fileTypeLabel = is_file($oldPath) ? "fichier" : "dossier";
				
				// Détermine le type de fichier en fonction du chemin
				$fileType = is_file($oldPath) ? "file" : "folder";
				
				// debug($dirDest);
				// debug($oldPath);
				// debug($oldThumbpath);
				// debug($newPath);
				// debug($newThumbpath);
				// die;
				
				// Tente de déplacer le fichier ou le répertoire
				if (rename($oldPath, $newPath)) {
					if (is_dir($oldThumbpath) || file_exists($oldThumbpath)) {
						rename($oldThumbpath, $newThumbpath);
					}
					// Si le déplacement a réussi, crée un message de succès
					$message = array("Le ". $fileTypeLabel ." <strong>'". $fileOldpath ."'</strong> a bien été déplacé dans le dossier <strong>'". $fileNewpath ."'</strong>", "success", $fileType);
				} else {
					// Sinon, crée un message d'erreur
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
			
			// debug($pathFolder . $fileRename[$i]);
			// debug($pathThumbFolder . $fileRename[$i]);
			// debug($pathThumbFolder . $newFileName);
			// debug($newname ."-". $i .".". $pathInfo);
			// debug($newFileName);
			// debug($fileNewname);
			// die;
			
			// Si c'est un fichier, on le supprime directement
			unlink($targetFile);
			
			if (file_exists($targetThumbFile)) {
				unlink($targetThumbFile);
			}
		} elseif ($type === 'dir') {
			$pathFolder = $path ."/". $file;
			$targetFolder = $rootFolder . $path ."/". $file;
			$targetThumbFolder = $rootFolder ."/thumbnails". $path ."/". $file;
			$dirDeleted[] = $file;
			
			// Si c'est un dossier, on ouvre le dossier et on supprime tous les fichiers/dossiers à l'intérieur
			$files = array_diff(scandir($targetFolder), array('.', '..'));
			
			foreach ($files as $fileName) {
                $fileType = is_file($targetFolder ."/". $fileName) ? 'file' : 'dir';
				self::remove($pathFolder, $fileName, $fileType, $rootFolder, $fileDeleted, $dirDeleted);
			}
			
			// On supprime ensuite le dossier lui-même
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
			// Si le type n'est ni 'file', ni 'dir', ni un tableau, on lance une exception
			$message = "Le paramètre $type doit être 'file', 'dir' ou $file un tableau";
			$successType = "danger";
			// throw new Exception('Le paramètre $type doit être "file", "dir" ou un tableau');
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
	 * Supprime de manière récursive tous les fichiers et dossiers dans le répertoire spécifié.
	 *
	 * @param string $dir Le répertoire à supprimer.
	 * @return bool True si la suppression est réussie, sinon false.
	 */
	/* public static function remove(string $path): bool {
        if (!file_exists($path)) {
            return false;
        }
        if (is_dir($path)) {
            $files = scandir($path);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    self::remove("$path/$file");
                }
            }
            return rmdir($path);
        } else {
            return unlink($path);
        }
    } */
    
	/**
	 * Déplace de manière récursive tous les fichiers et dossiers du répertoire source vers le répertoire destination.
	 * Si le répertoire destination n'existe pas, il sera créé.
	 * Si le fichier ou le dossier de destination existe déjà, il sera remplacé.
	 *
	 * @param string $src Le répertoire source.
	 * @param string $dest Le répertoire destination.
	 * @return bool True si le déplacement est réussi, sinon false.
	 */
    /* public static function move(string $source, string $destination): bool {
        if (!file_exists($source)) {
            return false;
        }
        if (is_dir($source)) {
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }
            $files = scandir($source);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    self::move("$source/$file", "$destination/$file");
                }
            }
            // return rmdir($source);
			return true;
        } else {
            return rename($source, $destination);
        }
    } */
	
    /**
     * Crée un nouveau répertoire.
     * 
     * @param string $path Le chemin du nouveau répertoire à créer.
     * @return bool Vrai si le répertoire a été créé, faux sinon.
     */
    /* public static function createDirectory(string $path): bool {
        if (!file_exists($path)) {
            // return mkdir($path, 0777, true);
            return mkdir($path, 0705, true);
        }
        return false;
	} */
	
	/**
	 * Crée un dossier dans un répertoire personnel avec un message de retour
	 *
	 * @param string $folderName Le nom du dossier à créer
	 * @param string $rootFolder Le chemin du répertoire personnel
	 * @return array Un tableau avec le message de retour et le type de message
	 */
    public static function createDir(string $folderName, string $rootFolder, bool $addThumbsDir = true): array {
		// Supprime tous les caractères de la chaîne de caractères indésirables du nom du dossier
		// $folderName = self::strReplace($folderName);
		$folderName = self::strReplace(trim($folderName));
		
		// Si le premier caractère est "/", retire-le du nom du dossier
		if ($folderName[0] === '/') {
			$folderName = substr($folderName, 1);
			debug($folderName);
		}
		
		// Trouve la position du premier slash "/" dans le nom du dossier
		$slashFinded = strpos($folderName, "/", 1);
		
		// Définit le chemin complet pour créer le dossier
		$targetDir = $rootFolder ."/". $folderName;
		$targetThumbDir = $rootFolder ."/thumbnails/". $folderName;
		
		if (!is_dir($targetDir)) { // Vérifie si le dossier existe déjà
			if (mkdir($targetDir, 0705, true)) { // Crée le dossier
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
					
					// Itération sur chaque sous-dossier
					foreach($folderArrayName as $folder) {
						// Ajout du nom du sous-dossier au chemin du dossier cible
						$targetArrayDir .= "/". trim($folder);
						
						// Ajout d'un fichier index.php au sous-dossier cible
						self::addFile($targetArrayDir);
					}
				}
				$message = array("Le dossier ". basename($folderName) ." a été créé avec succès", "success");
				// Enregistre une entrée de journal avec le message de succès
				// logs($this->session->readSession('user')['id'] ."|". $message[1] ."|". $message[0] ."|". __METHOD__ ."|". __LINE__);
			} else {
				$message = array("Le dossier ". basename($folderName) ." n'a pas pu être créé !", "danger");
				// logs($this->session->readSession('user')['id'] ."|". $message[1] ."|". $message[0] ."|". __METHOD__ ."|". __LINE__);
			}
		} else {
			$message = array("Le dossier ". basename($folderName) ." existe déjà !", "warning");
			// logs($this->session->readSession('user')['id'] ."|". $message[1] ."|". $message[0] ."|". __METHOD__ ."|". __LINE__);
		}
		
		// Retourner le message correspondant à l'action effectuée
		return $message;
    }
	
    /**
     * Récupère la taille d'un tableau de fichiers en octets.
     * 
     * @param string $files Les fichiers dont on veut récupérer la taille.
     * @return int La taille des fichiers en octets.
     */
    public static function getFilesSize(array $files): int {
		$total_file_size = 0;
		
		foreach($files as $size) {
			// debug($total_file_size);
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
		// àâäãæåāăąáçéèêëēėęěĕəíìîïīįıñóòôöøõōőœúùûüūůűųÿý()-()///_'!@#£¥₩€+×÷=$%^&(){}[]°•;,`~○●□■♤♡◇♧☆▪¤《》¡¿*\
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
		// $replaced = strtolower(str_replace($search, $replace, $string));
		// $replaced = str_replace(array("’", "-."), array("-", "."), $replaced);
		
		// debug($replaced, true);
		
		// return $replaced;
		return str_replace("-.", ".", strtolower(str_replace($search, $replace, $string)));
	}
	
   /**
	* Vérification et réencodage en UTF-8 si nécessaire pour éviter les problèmes d'encodage.
	* Conversion des caractères spéciaux en entités HTML pour éviter les problèmes d'encodage.
	* Remplacement des entités HTML accentuées par leurs caractères de base pour simplifier la chaîne.
	* Décodage des entités HTML pour récupérer les caractères de base.
	* Remplacement de tout ce qui n'est pas une lettre ou un chiffre par un tiret.
	* Conversion de la chaîne en minuscules et suppression des tirets en début et fin de chaîne pour obtenir un alias valide.
	* Renvoi de l'alias généré en sortie de la fonction.
	* 
	* Cette fonction prend en entrée une chaîne de caractères $str et retourne une version simplifiée (alias).
	* Elle est utilisée pour créer des alias à partir de chaînes de caractères en suivant un processus de normalisation.
	*
	* @param string $str La chaîne de caractères à convertir en alias.
	* @return string L'alias résultant de la chaîne de caractères donnée.
	*/
	public static function getAlias($str){
		// Vérifie si la chaîne est déjà encodée en UTF-32 et si oui, la réencode en UTF-8
		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
			$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		
		// Convertit les caractères spéciaux en entités HTML pour éviter les problèmes d'encodage
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		// Remplace les entités HTML accentuées par leur caractère de base (par exemple: &eacute; -> é)
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
		// Décode les entités HTML pour récupérer les caractères de base
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		// Remplace tout ce qui n'est pas une lettre ou un chiffre par un tiret
		// Remplace également plusieurs tirets consécutifs par un seul tiret
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
		// Convertit la chaîne en minuscules et supprime les tirets en début et fin de chaîne
		$str = strtolower( trim($str, '-') );
		
		return $str;
	}
	
    // Ajouter d'autres fonctions utiles ici...
	
}

/*
// Bien sûr, voici un exemple d'utilisation de la classe FileSystems pour lister récursivement tous les fichiers d'un répertoire et de ses sous-répertoires :
// Inclure la classe FileSystems
require_once 'FILESYSTEMS.php';

// Créer une instance de la classe FileSystems
$directory = new FileSystems();

// Récupérer tous les fichiers récursivement dans le répertoire /var/www/html
$files = $directory->getFilesRecursively('/var/www/html');

// Parcourir les fichiers et les afficher
foreach ($files as $file) {
    echo $file . '<br>';
}


// Et voici un exemple d'utilisation de la classe FileSystems pour supprimer récursivement un répertoire :
// Inclure la classe FileSystems
require_once 'filesystems.php';

// Créer une instance de la classe FileSystems
$directory = new FileSystems();

// Supprimer récursivement le répertoire /var/www/html/test
$directory->deleteRecursive('/var/www/html/test');


// Cette méthode peut être appelée directement en utilisant le nom de la classe, comme ceci :
$size = 1024 * 1024 * 5; // 5 Mo
echo FileSystems::getSizeName($size); // affiche "5 Mo"

// Dans cet exemple, nous appelons la fonction getScanFiles en utilisant la notation 
// de classe statique FileSystems::getScanFiles. Nous passons le chemin du répertoire 
// que nous voulons scanner en argument et stockons le résultat dans la variable $files. 
// Ensuite, nous vérifions si le tableau n'est pas vide, et si c'est le cas, nous 
// parcourons le tableau et imprimons chaque nom de fichier. Si la fonction renvoie false, 
// nous affichons un message indiquant qu'aucun fichier n'a été trouvé.
$files = FileSystems::getScanFiles('/path/to/directory');
if ($files !== false) {
    foreach ($files as $file) {
        echo $file . "\n";
    }
} else {
    echo "No files found.\n";
}
*/

?>