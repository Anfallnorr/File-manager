<?php

defined('_EXEC') or die;

class com_datas extends Controllers {
	
	public function data(): void {
		$myFolder = $_SERVER['ORIG_PATH_INFO'];
		$userSession = $this->session->readSession('user');
		
		if( !class_exists('Customers') ) {
			$this->loadModels('Customers');
		}
		// Récupérer les informations du client actuel
		$getCustomer = $this->Customers->getCustomer($userSession['id']);
		
		if( !empty($userSession['datas']['expander']) ) {
			$expander = $userSession['datas']['expander'];
		} else {
			$expander = "true";
		}
		// debug($expander, true);
		
		if( is_dir($this->personnalRoot) ) {
			/* Récupère la liste des dossiers dans l'espace personnel */
			$personnalAllDirs = FileSystems::getDirs($this->personnalRoot, $this->personnalFolder, "thumbnails");
			
			if( $personnalAllDirs != "" ) {
				$personnalAllDepthDirs = FileSystems::getSliceDirs($personnalAllDirs, 10, false); /* Le 2eme paramètre concerne le chemin du serveur */
			} else {
				$personnalAllDepthDirs = array($this->personnalRoot);
			}
			
			/* Récupère l"espace total utilisé dans l"espace personnel */
			$personnalDriveTotal = FileSystems::getFiles($this->personnalRoot, "thumbnails");
			
			// Si des fichiers existent dans l'espace personnel, effectuer des calculs de taille et de pourcentage pour différentes catégories de fichiers
			if( $personnalDriveTotal != "" ) {
				// Obtenir la taille totale des fichiers
				$totalSize = FileSystems::getFilesSize($personnalDriveTotal);
				// Convertir la taille en une chaîne lisible par l'homme (par ex. Ko, Mo, Go, etc.)
				$sizeName = FileSystems::getSizeName($totalSize);
				// Calculer le pourcentage de l'espace utilisé par rapport à 1 Go
				$totalSizePercent = round(100 * $totalSize / 1000000000,2);
				
				// Categoriser les fichiers dans différentes catégories (documents, images, audios, vidéos, autres)
				$filesCategorized = FileSystems::categorizeFiles($personnalDriveTotal, true, true); // FileSystems::categorizeFiles(array $src, false $basename, false $path);
				
				// Récupérer les chemins et les noms de fichiers pour chaque catégorie
				$docSrc = $filesCategorized['documents']['src'];
				$docBasename = $filesCategorized['documents']['basename'];
				$docBasePath = $filesCategorized['documents']['path'];
				$imgSrc = $filesCategorized['images']['src'];
				$imgBasename = $filesCategorized['images']['basename'];
				$imgBasePath = $filesCategorized['images']['path'];
				$audioSrc = $filesCategorized['audios']['src'];
				$audioBasename = $filesCategorized['audios']['basename'];
				$audioBasePath = $filesCategorized['audios']['path'];
				$vidSrc = $filesCategorized['videos']['src'];
				$vidBasename = $filesCategorized['videos']['basename'];
				$vidBasePath = $filesCategorized['videos']['path'];
				$otherSrc = $filesCategorized['other']['src'];
				$otherBasename = $filesCategorized['other']['basename'];
				$otherBasePath = $filesCategorized['other']['path'];
				
				// Calculer la taille totale pour chaque catégorie de fichiers
				$totalDocSize = FileSystems::getSize($docSrc);
				$totalImgSize = FileSystems::getSize($imgSrc);
				$totalAudioSize = FileSystems::getSize($audioSrc);
				$totalVidSize = FileSystems::getSize($vidSrc);
				$totalOtherSize = FileSystems::getSize($otherSrc);
				
				// Convertir les tailles en chaînes lisibles par l'homme (par ex. Ko, Mo, Go, etc.)
				$docSizeName = FileSystems::getSizeName($totalDocSize);
				$imgSizeName = FileSystems::getSizeName($totalImgSize);
				$audioSizeName = FileSystems::getSizeName($totalAudioSize);
				$vidSizeName = FileSystems::getSizeName($totalVidSize);
				$otherSizeName = FileSystems::getSizeName($totalOtherSize);
				
				// Calculer le pourcentage de chaque catégorie de fichiers par rapport à 1 Go
				$totalDocSizePercent = round(100 * $totalDocSize / 1000000000,2);
				$totalImgSizePercent = round(100 * $totalImgSize / 1000000000,2);
				$totalAudioSizePercent = round(100 * $totalAudioSize / 1000000000,2);
				$totalVidSizePercent = round(100 * $totalVidSize / 1000000000,2);
				$totalOtherSizePercent = round(100 * $totalOtherSize / 1000000000,2);
				
				// Définir des variables pour les données qui seront utilisées dans la vue
				$this->globalVars(
					array(
						'dataDir' => _ROOTURL_ ."/templates/html/datas/views/blocks/data",
						'myFolder' => $myFolder,
						'personnalFolder' => $this->personnalFolder,
						'personnalAllDirs' => $personnalAllDirs,
						'personnalAllDepthDirs' => $personnalAllDepthDirs,
						'totalSize' => $totalSizePercent,
						'sizeName' => $sizeName,
						'expander' => $expander,
						'totalDocSizePercent' => $totalDocSizePercent,
						'totalImgSizePercent' => $totalImgSizePercent,
						'totalAudioSizePercent' => $totalAudioSizePercent,
						'totalVidSizePercent' => $totalVidSizePercent,
						'totalOtherSizePercent' => $totalOtherSizePercent,
						'docSizeName' => $docSizeName,
						'imgSizeName' => $imgSizeName,
						'audioSizeName' => $audioSizeName,
						'vidSizeName' => $vidSizeName,
						'otherSizeName' => $otherSizeName,
						'docBasename' => $docBasename,
						'docBasePath' => $docBasePath,
						'nbDocFiles' => count($docSrc),
						'imgBasename' => $imgBasename,
						'imgBasePath' => $imgBasePath,
						'nbImgFiles' => count($imgSrc),
						'audioBasename' => $audioBasename,
						'audioBasePath' => $audioBasePath,
						'nbAudioFiles' => count($audioSrc),
						'vidBasename' => $vidBasename,
						'vidBasePath' => $vidBasePath,
						'nbVidFiles' => count($vidSrc),
						'otherBasename' => $otherBasename,
						'otherBasePath' => $otherBasePath,
						'nbOtherFiles' => count($otherSrc)
					)
				);
			} else {
				// Si le dossier personnel de l'utilisateur n'existe pas ou est vide
				// Définir les valeurs par défaut pour les variables
				$totalSizePercent = "0";
				$sizeName = "0 Ko";
				$docSrc = array();
				$imgSrc = array();
				$audioSrc = array();
				$vidSrc = array();
				$otherSrc = array();
				
				// Définir des variables pour les données qui seront utilisées dans la vue
				$this->globalVars(
					array(
						'dataDir' => _ROOTURL_ ."/templates/html/datas/views/blocks/data",
						'myFolder' => $myFolder,
						'personnalFolder' => $this->personnalFolder,
						'personnalAllDirs' => $personnalAllDirs,
						'personnalAllDepthDirs' => $personnalAllDepthDirs,
						'totalSize' => $totalSizePercent,
						'sizeName' => $sizeName,
						'totalDocSizePercent' => "0",
						'totalImgSizePercent' => "0",
						'totalAudioSizePercent' => "0",
						'totalVidSizePercent' => "0",
						'totalOtherSizePercent' => "0",
						'expander' => $expander,
						'nbDocFiles' => count($docSrc),
						'nbImgFiles' => count($imgSrc),
						'nbAudioFiles' => count($audioSrc),
						'nbVidFiles' => count($vidSrc),
						'nbOtherFiles' => count($otherSrc)
					)
				);
			}
		} else {
			// Si l'utilisateur est connecté mais aucune variable de requête n'est présente
			// Définir des variables pour les données qui seront utilisées dans la vue
			$this->globalVars(
				array(
					'dataDir' => _ROOTURL_ ."/templates/html/datas/views/blocks/data",
					'personnalFolder' => $this->personnalFolder
				)
			);
		}
		
		if( !empty($this->requests->params) ) {
			$breadcrumb = $this->requests->params;
			$path = $this->requests->params;
			$pathImploded = implode("/", $path);
			
			$this->globalVars(
				array(
					'breadcrumb' => $breadcrumb,
					'path' => $path
				)
			);
			
			$this->session->editSession('user', array('path' => $this->requests->params), "datas");
		} else {
			$this->globalVars(array('breadcrumb' => ""));
			$this->session->editSession('user', array('path' => array()), "datas");
		}
		
		// Vérifier si des paramètres sont présents dans les requêtes GET
		if( !empty($this->requests->get) ) {
			$get = get_object_vars($this->requests->get);
			
			if( $get['action'] == "upload" || $get['action'] == "uploadAjax" ) {
				// Vérifier si l'action dans les requêtes GET est "upload" ou "uploadAjax"
				// Vérifier si des données POST et des fichiers (file_documents) sont présents
				if( !empty($this->requests->post) && (isset($this->requests->files->file_documents) && !empty($this->requests->files->file_documents)) ) {
					$post = $this->requests->post;
					
					// Vérifier si le maximum de taille de dossier et la taille postée sont valides pour l'opération de téléversement
					if( $post->max_size_folder == $get['max_size_folder'] && ($get['max_size_folder'] < 100 && $post->max_size_folder < 100) ) {
						// Récupérer les fichiers uploadés dans un tableau
						$files = $this->requests->files->file_documents;
						
						// Vérifier si le chemin du fichier est défini dans les données POST
						if( !empty($post->file_path) ) {
							if( isset($get['resize']) && $get['resize'] == "0" ) {
								$personnalRoot = $this->personnalThumbRoot . $post->file_path;
							} else {
								$personnalRoot = $this->personnalRoot . $post->file_path;
							}
							$personnalRootThumb = $this->personnalThumbRoot . $post->file_path;
						} else {
							if( isset($get['resize']) && $get['resize'] == "0" ) {
								$personnalRoot = $this->personnalThumbRoot;
							} else {
								$personnalRoot = $this->personnalRoot;
							}
							$personnalRootThumb = $this->personnalThumbRoot;
						}
						
						// Effectuer l'opération d'upload des fichiers en utilisant la classe FileSystems
						$getAction = FileSystems::upload($files, $personnalRoot, $this->fileFormat(), $getCustomer['access']);
						
						// Vérifier si l'opération d'upload a réussi
						if( $getAction[1] == "success" ) {
							// Si le paramètre 'resize' est défini à "1", vérifier si les fichiers uploadés sont des images pour effectuer un redimensionnement
							if( isset($get['resize']) && $get['resize'] == "1" ) {
								$isImages = array();
								
								// Parcourir les fichiers uploadés pour vérifier s'ils sont des images
								for($i = 0; $i < count($getAction['name']); $i++) {
									if( in_array($getAction['type'][$i], array("image/jpeg", "image/jpg", "image/png")) ) {
										// Si le fichier est une image, ajouter son nom au tableau $isImages
										if( $getAction['width'][$i] < 9000 || $getAction['height'][$i] < 9000 ) {
											$isImages[] = $getAction['name'][$i];
										}
									}
								}
								
								if( !empty($isImages) ) {
									// Si des images sont trouvées dans le tableau $isImages, effectuer le redimensionnement
									try {
										FileSystems::resizeImages($isImages, $personnalRoot, $personnalRootThumb, 800);
									} catch (Exception $e) {
										// En cas d'erreur lors du redimensionnement, mettre à jour le message d'action et changer le type d'action en "warning"
										$getAction[0] .= " ". $e->getMessage();
										$getAction[1] = "warning";
									}
								}
							}
						}
					} else {
						// Si la taille maximale du dossier est dépassée, définir un message d'erreur
						$getAction = array("Votre espace de stockage est plein, veuillez supprimer des fichiers avant de continuer !", "danger");
					}
				} else {
					// Si des données POST ou des fichiers ne sont pas présents, définir un message d'erreur
					$getAction = array("Une erreur est survenue !", "danger");
				}
				
				// Si l'action est "uploadAjax", retourner le résultat de l'opération en format JSON pour une utilisation dans la partie frontend
				if( $get['action'] == "uploadAjax" ) {
					echo json_encode($getAction);
					exit;
				}
			}
			// Si l'action dans les requêtes GET est "remove"
			elseif( $get['action'] == "remove" ) {
				// Appeler la méthode remove() de la classe FileSystems pour supprimer le fichier ou dossier spécifié
				// Les paramètres passés sont le chemin du fichier/dossier à supprimer, le nom du fichier/dossier, le type (file/directory), et le chemin racine
				$getAction = FileSystems::remove($get['path'], $get['file'], $get['type'], $this->personnalRoot);
			}
			// Si l'action dans les requêtes GET est "download"
			elseif( $get['action'] == "download" ) {
				// Vérifier le type de téléchargement (fichier ou dossier)
				if( $get['type'] == "dir" ) {
					try {
						// Créer un objet Archiver pour gérer le téléchargement d'un dossier
						$archiver = new Archiver($this->personnalRoot . $get['path'] ."/". $get['file'], $this->tmpRoot, $get['file']);
						// Vérifier si le téléchargement est effectué en mode AJAX (true) ou non (false)
						if( isset($this->requests->post->ajax) && $this->requests->post->ajax == true ) {
							// Télécharger l'archive en mode AJAX
							$getAction = $archiver->downloadArchive(true);
						} else {
							// Télécharger l'archive en mode normal
							$getAction = $archiver->downloadArchive(false);
						}
					} catch (Exception $e) {
						$getAction = array($e->getMessage(), "danger");
					}
				} elseif( $get['type'] == "file" ) {
					// Utiliser le chemin du fichier à télécharger depuis le dossier personnel de l'utilisateur connecté
					$pathToFile = $this->personnalRoot . $get['path'] ."/". $get['file'];
					
					try {
						// Créer un objet Downloader pour gérer le téléchargement du fichier
						$downloader = new Downloader($pathToFile, $this->tmpRoot, $get['file']);
						// Appeler la méthode download() pour télécharger le fichier
						$getAction = $downloader->download($this->requests->path);
					} catch (Exception $e) {
						$getAction = array($e->getMessage(), "danger");
					}
				} else {
					// Si le type de téléchargement n'est ni "dir" ni "file", définir un message d'erreur
					$getAction = array("ERREUR : BLAAAAHHHH", "danger");
				}
			}
			// Si l'action dans les requêtes GET est "archive"
			elseif( $get['action'] == "archive" ) {
				// Vérifier le type de téléchargement (fichier ou dossier)
				if( $get['type'] == "dir" ) {
					try {
						// Créer un objet Archiver pour gérer la création de l'archive du dossier spécifié
						$archiver = new Archiver($this->personnalRoot . $get['path'] ."/". $get['file'], $this->personnalRoot . $get['path'] ."/", $get['file']);
						
						// Vérifier si la création de l'archive doit être effectuée en mode AJAX (true) ou non (false)
						if( isset($this->requests->post->ajax) && $this->requests->post->ajax == true ) {
							// Créer l'archive en mode AJAX
							$getAction = $archiver->createArchive(true);
						} else {
							// Créer l'archive en mode normal
							$getAction = $archiver->createArchive(false);
						}
					} catch (Exception $e) {
						$getAction = array($e->getMessage(), "danger");
					}
				} else {
					$getAction = array("Un dossier doit être sélectionné !", "warning");
				}
			} else {
				$getAction = array("Une erreur est survenue", "danger");
			}
			
			// Définir le message d'action et le type d'action en fonction du résultat du traitement
			$message = $getAction[0];
			$type = $getAction[1];
			
			if( !empty($message) && !empty($type) ) {
				$this->session->setNotifications($message, $type);
				
				header("Location: ". $this->requests->path);
				exit;
			}
		}
		
		if( !empty($this->requests->post) ) {
			$post = $this->requests->post;
			
			// Vérifier si l'utilisateur souhaite ajouter un dossier
			if( !empty($post->add_folder) ) {
				// Vérifier si le nom de dossier est spécifié
				if( !empty($post->folder_name) ) {
					$folderName = $post->folder_name;
					
					// Si un chemin (breadcrumb) est défini, ajouter le nom du dossier à ce chemin
					if( isset($path) ) {
						$folderPath = $pathImploded;
						$folderName = $folderPath ."/". $folderName;
					}
					
					// Créer le dossier en utilisant la méthode createDir de la classe FileSystems
					$createDir = FileSystems::createDir($folderName, $this->personnalRoot);
					
					$message = $createDir[0];
					$type = $createDir[1];
				} else {
					$message = "Veuillez entré un nom de dossier";
					$type = "warning";
				}
				
			}
			elseif( !empty($post->file_upload) ) {
				// Si l'utilisateur a soumis des fichiers à uploader
				$files = $this->requests->files;
				
				if( $files->file_documents['error'][0] === UPLOAD_ERR_OK ) {
					// Vérifier si l'espace de stockage maximum est inférieur à 100
					if( $post->max_size_folder < 100 ) {
						// Vérifier si tous les fichiers sélectionnés ont été téléchargés
						foreach($files->file_documents['tmp_name'] as $value) {
							if( empty($value) ) {
								$isEmpty = true;
								break;
							} else {
								$isEmpty = false;
							}
						}
						
						// Si au moins un fichier n'a pas été téléchargé correctement
						if( $isEmpty !== true ) {
							// Vérifier s'il y a eu des erreurs lors du téléchargement des fichiers
							foreach($files->file_documents['error'] as $fileErrors) {
								if( $fileErrors === true ) {
									$fileError = true;
									break;
								} else {
									$fileError = false;
								}
							}
							
							// Si aucun fichier n'a rencontré d'erreurs lors du téléchargement
							if( $fileError === false ) {
								// Récupérer les informations sur les fichiers téléchargés
								$fileDocuments = $files->file_documents;
								
								// Si un chemin (breadcrumb) est défini, ajouter le chemin au téléchargement des fichiers
								if( !empty($path) ) {
									$fileDocuments['file_path'] = $pathImploded;
								}
								
								// Appeler la méthode massUploads pour gérer le téléchargement des fichiers
								$fileUploaded = $this->massUploads($fileDocuments, $getCustomer);
								
								$message = $fileUploaded[0];
								$type = $fileUploaded[1];
							} else {
								$message = "Un fichier à rencontrer une erreur";
								$type = "danger";
							}
						} else {
							$message = "Aucun fichier séléctionné";
							$type = "warning";
						}
					} else {
						$message = "Votre espace de stockage est plein, veuillez supprimer des fichiers avant de continuer !";
						$type = "danger";
					}
				} else {
					$message = "Aucun fichier sélectionné !";
					$type = "warning";
				}
			} 
			elseif( !empty($post->action_mass_download) ) {
				// Si l'utilisateur a soumis une action de téléchargement en masse
				// Vérifier si des fichiers ont été sélectionnés pour le téléchargement en masse
				if( !empty($post->select_file) ) {
					// Récupérer les informations sur les fichiers sélectionnés pour le téléchargement
					$massDownload = $post->select_file;
					$massDownload['root'] = $this->personnalRoot;
					$massDownload['file_path'] = !empty($path) ? $pathImploded : "";
					
					try {
						// Créer un objet Archiver pour gérer le téléchargement en masse des fichiers
						$archiver = new Archiver($massDownload, $this->tmpRoot);
						
						// Vérifier s'il s'agit d'une requête Ajax pour déterminer si l'archive doit être téléchargée immédiatement ou non
						if( isset($post->ajax) && $post->ajax == true ) {
							// Télécharger l'archive immédiatement
							$getAction = $archiver->downloadArchive(true);
						} else {
							// Préparer l'archive sans la télécharger immédiatement
							$getAction = $archiver->downloadArchive(false);
						}
					} catch (Exception $e) {
						$getAction = array($e->getMessage(), "danger");
					}
				} else {
					$message = "Aucun fichier sélectionné";
					$type = "warning";
				}
			}
			elseif( !empty($post->action_mass_move) ) {
				// Si l'utilisateur a soumis une action de déplacement en masse
				// Vérifier si des fichiers ont été sélectionnés pour le déplacement en masse
				if( !empty($post->select_file) ) {
					// Appeler la fonction de déplacement pour déplacer les fichiers
					$massMoved = FileSystems::move($post->mass_move['old_path'], $post->mass_move['new_path'], $this->personnalRoot, $post->select_file);
				} else {
					$massMoved = array("Aucun fichier sélectionné", "warning");
				}
				
				$message = $massMoved[0];
				$type = $massMoved[1];
			} 
			elseif( !empty($post->action_mass_rename) ) {
				// Si l'utilisateur a soumis une action de renommage en masse
				// Vérifier si des fichiers ont été sélectionnés pour le renommage en masse
				if( !empty($post->select_file) ) {
					// Copier les fichiers sélectionnés dans une variable
					$massRenamerSelectFile = $post->select_file;
					
					// Si un chemin est défini, mettre à jour le chemin des fichiers sélectionnés
					if( !empty($path) ) {
						$massRenamerSelectFile['file_path'] = $pathImploded;
					}
					
					// Appeler la fonction de renommage pour renommer les fichiers
					$massRenamer = FileSystems::renamer($massRenamerSelectFile, $post->mass_renamer['name'], $personnalDriveTotal, $this->personnalRoot);
				} else {
					$massRenamer = array("Aucun fichier sélectionné". __LINE__, "warning");
				}
				
				$message = $massRenamer[0];
				$type = $massRenamer[1];
			} 
			elseif( !empty($post->action_mass_remove) ) {
				// Si l'utilisateur a soumis une action de suppression en masse
				// Vérifier si des fichiers ont été sélectionnés pour la suppression en masse
				if( !empty($post->select_file) ) {
					// Copier les fichiers sélectionnés dans une variable
					$massRemoveSelectFile = $post->select_file;
					$massRemoveFilePath = "";
					
					// Si un chemin est défini, mettre à jour le chemin des fichiers sélectionnés
					if( !empty($path) ) {
						$massRemoveFilePath = "/". $pathImploded;
					}
					
					// Appeler la fonction de suppression pour supprimer les fichiers sélectionnés
					$massRemoved = FileSystems::remove($massRemoveFilePath, $massRemoveSelectFile, "", $this->personnalRoot);
				} else {
					$massRemoved = array("Aucun fichier sélectionné", "warning");
				}
				
				$message = $massRemoved[0];
				$type = $massRemoved[1];
			} 
			elseif(!empty($post->file_renamer) || !empty($post->dir_renamer) || !empty($post->file_move) || !empty($post->dir_move)) {
				// Si l'utilisateur a soumis une action de renommage ou de déplacement de fichiers ou de dossiers
				// Vérifier quelle action a été soumise (renommage de fichier, renommage de dossier, déplacement de fichier ou déplacement de dossier)
				// Et récupérer les nouvelles valeurs soumises pour chaque type d'action (nouveau nom de fichier, nouveau nom de dossier, nouveau chemin de déplacement)
				if( !empty($post->file_renamer) ) {
					foreach( $post->file_renamer['file'] as $key => $value ) {
						if( !empty($value) ) {
							$fileRenamerKey = $key;
							$fileRenamer['newname'] = $value;
							break;
						}
					}
				}
				
				if( !empty($post->dir_renamer) ) {
					foreach( $post->dir_renamer['dir'] as $key => $value ) {
						if( !empty($value) ) {
							$dirRenamerKey = $key;
							$dirRenamer['newname'] = $value;
							break;
						}
					}
				}
				
				if( !empty($post->file_move) ) {
					foreach( $post->file_move['new_path'] as $key => $value ) {
						if( !empty($value) ) {
							$fileMoveKey = $key;
							$fileMove['new_path'] = $value;
							break;
						}
					}
				}
				
				if( !empty($post->dir_move) ) {
					foreach( $post->dir_move['new_path'] as $key => $value ) {
						if( !empty($value) ) {
							$dirMoveKey = $key;
							$dirMove['new_path'] = $value;
							break;
						}
					}
				}
				
				// En fonction de l'action soumise, exécuter l'action correspondante (renommage ou déplacement)
				// Utiliser les informations récupérées pour chaque type d'action (ancien nom/chemin et nouveau nom/chemin) et appeler la fonction appropriée
				if( isset($fileRenamerKey) ) {
					$fileRenamer['oldname'] = $this->personnalRoot . $post->file_renamer['path'][$fileRenamerKey];
					$pdt = gettype($personnalDriveTotal) != "boolean" ? $personnalDriveTotal : array();
					$outputAction = FileSystems::renamer($fileRenamer['oldname'], $fileRenamer['newname'], $pdt, $this->personnalRoot);
				} 
				elseif( isset($dirRenamerKey) ) {
					$dirRenamer['oldname'] = $this->personnalRoot . $post->dir_renamer['path'][$dirRenamerKey];
					$pdt = gettype($personnalDriveTotal) != "boolean" ? $personnalDriveTotal : array();
					$outputAction = FileSystems::renamer($dirRenamer['oldname'], $dirRenamer['newname'], $pdt, $this->personnalRoot);
				} 
				elseif( isset($fileMoveKey) ) {
					$fileMove['new_path'] = $this->personnalRoot . $fileMove['new_path'];
					$fileMove['old_path'] = $this->personnalRoot . $post->file_move['old_path'][$fileMoveKey];
					$outputAction = FileSystems::move($fileMove['old_path'], $fileMove['new_path'], $this->personnalFolder);
				} 
				elseif( isset($dirMoveKey) ) {
					$dirMove['new_path'] = $this->personnalRoot . $dirMove['new_path'];
					$dirMove['old_path'] = $this->personnalRoot . $post->dir_move['old_path'][$dirMoveKey];
					$outputAction = FileSystems::move($dirMove['old_path'], $dirMove['new_path'], $this->personnalFolder);
				} 
				else {
					$outputAction = array("Veuillez remplir le champ", "warning");
				}
				
				$message = $outputAction[0];
				$type = $outputAction[1];
			} else {
				exit;
				die;
			}
			
			if( !empty($message) && !empty($type) ) {
				$this->session->setNotifications($message, $type);
				
				header("Location: ". $this->requests->path);
				exit;
			}
		}
	}
	
	public function massUploads(array $datas, array $getCustomer): array {
		if( $this->requests->post->max_size_folder < 100 ) {
			set_time_limit(3600);
			
			$file_format = $this->fileFormat();
			$accept_file_format = FileSystems::ACCEPT_FILE_FORMAT;
			
			if( is_array($datas) ) {
				$file_counter = count($datas['name']);
				$get_files = FileSystems::getFiles($this->personnalRoot);
				
				if( !empty($datas["file_path"]) ) {
					$target_dir = $this->personnalRoot ."/". $datas['file_path'] ."/";
				} else {
					$target_dir = $this->personnalRoot ."/";
				}
				
				if( !is_dir($target_dir) ) {
					mkdir($target_dir, 0705, true);
				}
				
				$redim = array();
				
				for( $i = 0; $i < $file_counter; $i++ ) {
					$datas['name'][$i] = FileSystems::strReplace($datas['name'][$i]);
					
					$target_file[$i] = $target_dir . basename($datas['name'][$i]);
					$imageFileType[$i] = strtolower(pathinfo($target_file[$i], PATHINFO_EXTENSION));
					
					// Vérifier si le fichier existe déjà
					/* if( !empty($get_files) ) {
						// foreach($get_files['file'] as $get_file) {
						foreach($get_files as $get_file) {
							if( basename($get_file) === basename($target_file[$i]) ) {
								$slice_file = array_slice(explode("/", $get_file), 10);
								$message = array("Un fichier du même nom existe déjà, '/". implode('/', $slice_file) ."'", "warning");
								// $uploadOk = 0;
								logs($this->session->readSession('user')['id'] ."|". $message[1] ."|". $message[0] ."|". __METHOD__ ."|". __LINE__);
								
								return $message;
							}
						}
					} */
					
					// Vérifier la taille du fichier en octets (ex: 20000o = 20Ko), (ex: 19300357o = 19.3Mo)
					if( $getCustomer['access'] > 2 ) {
						if( $datas['size'][$i] > 10000000 ) {
							$message = array("Désolé, le fichier est trop volumineux, taille max. 10Mo", "warning");
							
							return $message;
						}
					}
					
					// Autoriser certains formats de fichiers
					if( empty(in_array($imageFileType[$i], $this->fileFormat())) ) {
						$message = array("Désolé, les fichiers autorisé sont de type ". implode(", ", $this->fileFormat()) ."", "warning");
						
						return $message;
					}
					
					if( move_uploaded_file($datas['tmp_name'][$i], $target_file[$i]) ) {
						// Si tout va bien, on vérifie le type mime du fichier
						if( !empty(in_array(mime_content_type($target_file[$i]), $accept_file_format)) ) {
							// Si tout va bien, essayez de télécharger le fichier
							if( $file_counter > 1 ) {
								$message = array("L'enregistrement des fichiers s'est déroulé avec succès", "success");
							} else {
								$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($datas['name'][$i])) ." s'est déroulé avec succès", "success");
							}
						} else {
							// Pas bon, on supprime le fichier
							unlink($target_file[$i]);
							$message = array("L'enregistrement des fichiers doit être de type ". implode(", ", $accept_file_format) ."", "danger");
						}
					} else {
						if( $file_counter > 1 ) {
							$message = array("L'enregistrement des fichiers ont rencontrés une erreur !", "danger");
						} else {
							$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($datas['name'][$i])) ." à rencontré une erreur !", "danger");
						}
					}
				}
			}
		} else {
			$message = array("Votre espace de stockage est plein, veuillez supprimer des fichiers avant de continuer !", "danger");
		}
		
		return $message;
	}
	
	function fileFormat(): ?array {
		if( !class_exists('Params') ) {
			$this->loadModels('Params');
		}
		$getParams = $this->Params->getParams();
		
		return $file_format = explode(",", $getParams['accept_ext_file']);
	}
	
}

?>
