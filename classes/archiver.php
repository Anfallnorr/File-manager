<?php

/**
 * Classe Archiver
 * Manipule des archives ZIP en PHP
 */
class Archiver {
	
    private $zip;
    protected $archive;
    protected $destination;
    public $filename;
	
	/**
     * @param string $archive Chemin de l'archive à manipuler
     * @param string $destination Chemin de destination de l'archive
     */
    public function __construct(string|array $archive, string $destination, string $filename = "archive-js") {
        $this->zip = new ZipArchive;
		$this->filename = $filename ."_". date("Ymd-His") .".zip";
		
		$this->archive = $archive;
		$this->destination = $destination;
    }
	
	/**
     * Crée une archive ZIP contenant les fichiers spécifiés
     * 
     * @return bool Renvoie TRUE si l'archive a été créée avec succès, FALSE sinon
     */
	public function downloadArchive(bool $ajax = false): ?string {
		// Initialisation des tableaux de suivi des fichiers et des dossiers
		$hasFile = array();
		$hasDir = array();
		$partZip = array();
		
		// Définition du chemin complet du fichier à créer
		$fileDestination = $this->destination . $this->filename;
		
		// Vérification que le dossier destination existe
		if (!is_dir($this->destination)) {
			throw new Exception("Le répertoire destination n'existe pas.");
		}
		
		// Ouverture de l'archive
		$this->zip->open($fileDestination, ZipArchive::CREATE | ZipArchive::OVERWRITE);
		
		// Vérification du type d'archive à créer (soit un tableau avec les fichiers et les dossiers, soit un dossier seul)
		if (is_array($this->archive)) {
			// Récupération de l'emplacement racine de l'archive
			if (!empty($this->archive['file_path'])) {
				$thisRoot = $this->archive['root'] ."/". $this->archive['file_path'];
			} else {
				$thisRoot = $this->archive['root'];
			}
			
			// Ajout des dossiers de l'archive à l'archive créée
			if (isset($this->archive['dir'])) {
				for($i = 0; $i < count($this->archive['dir']); $i++) {
					$thisDir = $this->archive['dir'][$i];
					$rootDirArchive = $thisRoot ."/". $thisDir;
					
					if (!$this->addDir($rootDirArchive, $thisRoot, $hasFile, $ajax)) {
						throw new Exception("Une erreur est survenue !");
					}
				}
			}
			// Ajout des fichiers de l'archive à l'archive créée
			if (isset($this->archive['file'])) {
				if (!$this->addFiles($this->archive['file'], $thisRoot, $hasFile, $ajax)) {
					throw new Exception("Une erreur est survenue !");
				}
			}
		} else {
			// Vérification que le dossier source existe
			if (!is_dir($this->archive)) {
				throw new Exception("Le répertoire source n'existe pas.");
			}
			
			// Ajout des dossiers et des fichiers du dossier source à l'archive créée
			if (!$this->addDir($this->archive, $this->archive, $hasFile, $ajax)) {
				throw new Exception("Une erreur est survenue !");
			}
		}
		
		// Fermeture de l'archive
		if ($ajax !== false) {
			if ($this->zip->close()) {
				// Vérification qu'il y a au moins un fichier dans l'archive créée
				if (count($hasFile) > 0) {
					echo json_encode(array("La compression a réussi", "success", $this->filename));
					exit;
				} else {
					// Si aucun fichier n'a été ajouté, supprime le fichier d'archive créé lance une exception
					unlink($fileDestination);
					echo json_encode(array("Il n'y a aucun fichier dans l'archive", "danger"));
					exit;
				}
			} else {
				unlink($fileDestination);
				echo json_encode(array("Impossible de fermé l'archive", "danger"));
				exit;
			}
		} else {
			if ($this->zip->close()) {
				// Vérification qu'il y a au moins un fichier dans l'archive créée
				if (count($hasFile) > 0) {
					// Envoi des headers pour télécharger l'archive
					header('Content-Type: application/zip');
					header('Content-Transfer-Encoding: binary');
					header('Content-Disposition: attachment; filename="'. $this->filename .'"');
					header('Content-Length: '. filesize($fileDestination));
					header('Pragma: no-cache');
					header('Expires: 0');
					
					header('location: /uploads/tmp/'. $this->filename);
					exit;
				} else {
					// Si aucun fichier n'a été ajouté, supprime le fichier d'archive créé lance une exception
					unlink($fileDestination);
					throw new Exception("Il n'y a aucun fichier dans l'archive");
					exit;
				}
			} else {
				unlink($fileDestination);
				throw new Exception("Impossible de fermé l'archive");
				exit;
			}
		}
	}
	
	/**
     * Créer une archive zip à partir d'un répertoire source et de l'enregistrer dans un répertoire de destination.
     * 
     * @return array Renvoie TRUE Si des fichiers ont été ajoutés, retourne un tableau indiquant la réussite de la compression, FALSE sinon
     */
    public function createArchive(bool $ajax = false): string|array {
		// Crée un tableau pour stocker les noms des fichiers ajoutés à l'archive
		$hasFile = array();
		// Détermine le chemin complet du fichier d'archive à créer
		$fileDestination = $this->destination . $this->filename;
		
		// Vérifie si le répertoire source existe
		if (!is_dir($this->archive)) {
			// Si le répertoire source n'existe pas, lance une exception
			throw new Exception("Le répertoire source n'existe pas.");
		}
		
		// Vérifie si le répertoire de destination existe
		if (!is_dir($this->destination)) {
			// Si le répertoire de destination n'existe pas, lance une exception
			throw new Exception("Le répertoire destination n'existe pas.");
		}
		
		// Ouvre le fichier d'archive en mode création ou écrasement
		$this->zip->open($fileDestination, ZipArchive::CREATE | ZipArchive::OVERWRITE);
		
		// Ajoute les fichiers du répertoire source à l'archive
		if (!$this->addDir($this->archive, $this->archive, $hasFile)) {
			// Si une erreur survient pendant l'ajout des fichiers, lance une exception
			throw new Exception("Une erreur est survenue !");
		}
		
		if ($ajax !== false) {
			// Ferme le fichier d'archive et vérifie si des fichiers ont été ajoutés
			if ($this->zip->close() && count($hasFile) > 0) {
				// Si des fichiers ont été ajoutés, retourne un tableau indiquant la réussite de la compression
				echo json_encode(array("La compression a réussi", "success"));
				exit;
			} else {
				// Si aucun fichier n'a été ajouté, supprime le fichier d'archive créé et retourne un tableau indiquant l'échec de la compression
				unlink($fileDestination);
				echo json_encode(array("La compression a échoué", "warning"));
				exit;
			}
		} else {
			// Ferme le fichier d'archive et vérifie si des fichiers ont été ajoutés
			if ($this->zip->close() && count($hasFile) > 0) {
				// Si des fichiers ont été ajoutés, retourne un tableau indiquant la réussite de la compression
				return array("La compression a réussi", "success");
			} else {
				// Si aucun fichier n'a été ajouté, supprime le fichier d'archive créé et retourne un tableau indiquant l'échec de la compression
				unlink($fileDestination);
				return array("La compression a échoué", "warning");
			}
		}
    }
	
	/**
     * Ajoute un fichier à l'archive
     * 
     * @param string $file Chemin du fichier à ajouter
     * @param string|null $name Nom sous lequel le fichier sera ajouté à l'archive (optionnel)
     * @return bool Renvoie TRUE si le fichier a été ajouté avec succès, FALSE sinon
     */
    public function addFile(string $file, string $name = null): bool {
		if (is_null($name)) {
			$name = basename($file);
		}
		return $this->zip->addFile($file, $name);
	}
	
	/**
     * Ajoute des fichiers à l'archive
     * 
     * @param array $files Chemin des fichiers à ajouter
     * @param string $root Nom du chemin racine
     * @return bool Renvoie TRUE si les fichiers ont été ajouté avec succès, FALSE sinon
     */
    public function addFiles(array $files, string $root, array &$hasFile, bool $ajax = false): bool {
		for($i = 0; $i < count($files); $i++) {
			if ($files[$i] != "on") {
				$thisFile = $files[$i];
				$rootFileArchive = $root ."/". $thisFile;
				$relativePath = substr($rootFileArchive, strlen($root) + 1);
				
				if ($this->addFile($rootFileArchive, $relativePath)) {
					$hasFile[] = $relativePath;
				} else {
					throw new Exception("L'ajout du fichier '". basename($relativePath) ."' a échoué !");
				}
			}
			
			if ($i == 10) {
				sleep(5);
			}
		}
		
		if (count($hasFile) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Ajoute des fichiers à l'archive en plusieurs lots
	 *
	 * @param array $files Chemin des fichiers à ajouter
	 * @param string $root Nom du chemin racine
	 * @param int $batchSize Nombre de fichiers à ajouter par lot
	 * @param callable $progressCallback Fonction de rappel pour suivre la progression de l'ajout de fichiers
	 * @return bool Renvoie TRUE si les fichiers ont été ajoutés avec succès, FALSE sinon
	 */
	public function addFilesBatched(array $files, string $root, array &$hasFile, int $batchSize, callable $progressCallback): bool {
		for ($i = 0; $i < count($files); $i += $batchSize) {
			$batchFiles = array_slice($files, $i, $batchSize);
			$batchHasFile = array();
			
			for ($j = 0; $j < count($batchFiles); $j++) {
				$thisFile = $batchFiles[$j];
				$rootFileArchive = $root . "/" . $thisFile;
				$relativePath = substr($rootFileArchive, strlen($root) + 1);
				
				if ($this->addFile($rootFileArchive, $relativePath)) {
					$batchHasFile[] = $relativePath;
				} else {
					throw new Exception("L'ajout du fichier '". basename($relativePath) ."' a échoué !");
				}
			}
			
			$hasFile = array_merge($hasFile, $batchHasFile);
		}
		
		if (count($hasFile) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function progressCallback(int $numFilesAdded, int $totalNumFiles): void {
		$progressPercentage = round(($numFilesAdded / $totalNumFiles) * 100);
		echo "Progress: $progressPercentage%\n";
	}
	
	/**
     * Ajoute tous les fichiers d'un répertoire à l'archive
     * 
     * @param string $dir Chemin du répertoire à ajouter
     * @param string $root Chemin de base à partir duquel les fichiers sont ajoutés à l'archive (optionnel, par défaut le répertoire courant)
     */
    public function addDir(string $dir, string $root, array &$hasFile, bool $ajax = false) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
		
		foreach ($iterator as $file) {
			$filePath = $file->getRealPath();
			$relativePath = substr($filePath, strlen($root) + 1);
			
			if (!$file->isDir()) {
				if (!str_contains($relativePath, "index.php")) {
					if ($this->addFile($filePath, $relativePath)) {
						$hasFile[] = $relativePath;
					} else {
						throw new Exception("L'ajout du fichier '". basename($relativePath) ."' a échoué !");
					}
				}
			} elseif ($file->isDir()) {
				if (!empty($relativePath) && !in_array($relativePath, array(".", ".."))) {
					$this->zip->addEmptyDir($relativePath);
				}
			} else {
				throw new Exception("Une erreur est survenue !");
				return false;
			}
		}
		
		return true;
    }
	
	/**
     * Extrait les fichiers d'une archive ZIP vers un dossier spécifié
     * 
     * @param string $archiveName Nom de l'archive à extraire
     * @param string $destination Chemin du dossier de destination
     * @return bool Renvoie TRUE si l'archive a été extraite avec succès, FALSE sinon
     */
    public function extractArchive($archiveName, $destination) {
        // if ($this->zip->open($archiveName) === TRUE) {
            // $this->zip->extractTo($destination);
            // $this->zip->close();
            // return true;
        // }
        // return false;
    }
	
	/**
     * Récupère la liste des fichiers contenus dans l'archive.
     *
     * @return array|bool La liste des fichiers ou false en cas d'erreur.
     */
    public function getArchiveFiles() {
        // if ($this->archive && file_exists($this->archive)) {
            // $zip = new ZipArchive();
            // $zip->open($this->archive);

            // $files = [];
            // for ($i = 0; $i < $zip->numFiles; $i++) {
                // $filename = $zip->getNameIndex($i);
                // $files[] = $filename;
            // }

            // $zip->close();
            // return $files;
        // }

        // return false;
    }

    /**
     * Supprime un fichier de l'archive.
     *
     * @param string $filename Le nom du fichier à supprimer.
     *
     * @return bool true si le fichier a été supprimé, false sinon.
     */
    public function deleteFileFromZip($filename) {
        // if ($this->archive && file_exists($this->archive)) {
            // $zip = new ZipArchive();
            // if ($zip->open($this->archive) === true) {
                // $result = $zip->deleteName($filename);
                // $zip->close();
                // return $result;
            // }
        // }

        // return false;
    }

    /**
     * Ajoute un fichier à l'archive.
     *
     * @param string $filename Le chemin absolu vers le fichier à ajouter.
     * @param string|null $newname Le nom que portera le fichier dans l'archive, ou null pour garder le même nom.
     *
     * @return bool true si le fichier a été ajouté, false sinon.
     */
    public function addFileToZip($filename, $newname = null) {
        // if ($this->archive && file_exists($this->archive)) {
            // $zip = new ZipArchive();
			
            // if ($zip->open($this->archive, ZipArchive::CREATE) === true) {
                // if (!$newname) {
                    // $newname = basename($filename);
                // }
                // $result = $zip->addFile($filename, $newname);
                // $zip->close();
                // return $result;
            // }
        // }
		
        // return false;
    }

    /**
     * Extrait un fichier de l'archive vers le répertoire spécifié.
     *
     * @param string $filename Le nom du fichier à extraire.
     * @param string $destination Le répertoire de destination.
     *
     * @return bool true si le fichier a été extrait, false sinon.
     */
    public function extractFile($filename, $destination) {
        // if ($this->archive && file_exists($this->archive)) {
            // $zip = new ZipArchive();
            // if ($zip->open($this->archive) === true) {
                // $result = $zip->extractTo($destination, $filename);
                // $zip->close();
                // return $result;
            // }
        // }

        // return false;
    }
	
	/**
	 * Retourne une chaîne de statut en fonction du code de statut donné.
	 *
	 * @param int $status Le code de statut à rechercher.
	 * @return string La chaîne de statut correspondante.
	 */
	function getZipStatus(int $status): string {
		$statusMap = [
			ZipArchive::ER_OK => 'N No error',
			ZipArchive::ER_MULTIDISK => 'N Multi-disk zip archives not supported',
			ZipArchive::ER_RENAME => 'S Renaming temporary file failed',
			ZipArchive::ER_CLOSE => 'S Closing zip archive failed',
			ZipArchive::ER_SEEK => 'S Seek error',
			ZipArchive::ER_READ => 'S Read error',
			ZipArchive::ER_WRITE => 'S Write error',
			ZipArchive::ER_CRC => 'N CRC error',
			ZipArchive::ER_ZIPCLOSED => 'N Containing zip archive was closed',
			ZipArchive::ER_NOENT => 'N No such file',
			ZipArchive::ER_EXISTS => 'N File already exists',
			ZipArchive::ER_OPEN => 'S Can\'t open file',
			ZipArchive::ER_TMPOPEN => 'S Failure to create temporary file',
			ZipArchive::ER_ZLIB => 'Z Zlib error',
			ZipArchive::ER_MEMORY => 'N Malloc failure',
			ZipArchive::ER_CHANGED => 'N Entry has been changed',
			ZipArchive::ER_COMPNOTSUPP => 'N Compression method not supported',
			ZipArchive::ER_EOF => 'N Premature EOF',
			ZipArchive::ER_INVAL => 'N Invalid argument',
			ZipArchive::ER_NOZIP => 'N Not a zip archive',
			ZipArchive::ER_INTERNAL => 'N Internal error',
			ZipArchive::ER_INCONS => 'N Zip archive inconsistent',
			ZipArchive::ER_REMOVE => 'S Can\'t remove file',
			ZipArchive::ER_DELETED => 'N Entry has been deleted',
		];

		return $statusMap[$status] ?? sprintf('Unknown status %s', $status);
	}
}

?>