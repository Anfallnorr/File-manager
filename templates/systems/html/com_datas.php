<?php

defined('_EXEC') or die;

class com_datas extends Controllers {
	
	public function data(): void {
		$myFolder = $_SERVER['ORIG_PATH_INFO'];
		
		$userSession = $this->session->readSession('user');
		$getCustomer = $userSession;
		
		if( !empty($userSession['datas']['expander']) ) {
			$expander = $userSession['datas']['expander'];
		} else {
			$expander = "true";
		}
		
		if( is_dir($this->personnalRoot) ) {
			$personnalAllDirs = FileSystems::getDirs($this->personnalRoot, $this->personnalFolder, "thumbnails");
			
			if( $personnalAllDirs != "" ) {
				$personnalAllDepthDirs = FileSystems::getSliceDirs($personnalAllDirs, 10, false);
			} else {
				$personnalAllDepthDirs = array($this->personnalRoot);
			}
			
			$personnalDriveTotal = FileSystems::getFiles($this->personnalRoot, "thumbnails");
			
			if( $personnalDriveTotal != "" ) {
				$totalSize = FileSystems::getFilesSize($personnalDriveTotal);
				$sizeName = FileSystems::getSizeName($totalSize);
				$totalSizePercent = round(100 * $totalSize / 100000000,2);
				
				$filesCategorized = FileSystems::categorizeFiles($personnalDriveTotal, true, true);
				
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
				
				$totalDocSize = FileSystems::getSize($docSrc);
				$totalImgSize = FileSystems::getSize($imgSrc);
				$totalAudioSize = FileSystems::getSize($audioSrc);
				$totalVidSize = FileSystems::getSize($vidSrc);
				$totalOtherSize = FileSystems::getSize($otherSrc);
				
				$docSizeName = FileSystems::getSizeName($totalDocSize);
				$imgSizeName = FileSystems::getSizeName($totalImgSize);
				$audioSizeName = FileSystems::getSizeName($totalAudioSize);
				$vidSizeName = FileSystems::getSizeName($totalVidSize);
				$otherSizeName = FileSystems::getSizeName($totalOtherSize);
				
				$totalDocSizePercent = round(100 * $totalDocSize / 100000000,2);
				$totalImgSizePercent = round(100 * $totalImgSize / 100000000,2);
				$totalAudioSizePercent = round(100 * $totalAudioSize / 100000000,2);
				$totalVidSizePercent = round(100 * $totalVidSize / 100000000,2);
				$totalOtherSizePercent = round(100 * $totalOtherSize / 100000000,2);
				
				$this->globalVars(
					array(
						'dataDir' => _ROOTURL_ ."/templates/". $this->theme ."/html/datas/views/blocks/data",
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
				$totalSizePercent = "0";
				$sizeName = "0 Ko";
				$docSrc = array();
				$imgSrc = array();
				$audioSrc = array();
				$vidSrc = array();
				$otherSrc = array();
				
				$this->globalVars(
					array(
						'dataDir' => _ROOTURL_ ."/templates/". $this->theme ."/html/datas/views/blocks/data",
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
			$this->globalVars(
				array(
					'dataDir' => _ROOTURL_ ."/templates/". $this->theme ."/html/datas/views/blocks/data",
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
		
		if( !empty($this->requests->get) ) {
			$get = get_object_vars($this->requests->get);
			
			if( $get['action'] == "upload" || $get['action'] == "uploadAjax" ) {
				if( !empty($this->requests->post) && (isset($this->requests->files->file_documents) && !empty($this->requests->files->file_documents)) ) {
					$post = $this->requests->post;
					
					if( $post->max_size_folder == $get['max_size_folder'] && ($get['max_size_folder'] < 100 && $post->max_size_folder < 100) ) {
						$files = $this->requests->files->file_documents;
						
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
						
						$getAction = FileSystems::upload($files, $personnalRoot, $this->fileFormat(), $getCustomer['access']);
						
						if( $getAction[1] == "success" ) {
							if( isset($get['resize']) && $get['resize'] == "1" ) {
								$isImages = array();
								
								for($i = 0; $i < count($getAction['name']); $i++) {
									if( in_array($getAction['type'][$i], array("image/jpeg", "image/jpg", "image/png")) ) {
										if( $getAction['width'][$i] < 9000 || $getAction['height'][$i] < 9000 ) {
											$isImages[] = $getAction['name'][$i];
										}
									}
								}
								
								if( !empty($isImages) ) {
									try {
										FileSystems::resizeImages($isImages, $personnalRoot, $personnalRootThumb, 800);
									} catch (Exception $e) {
										$getAction[0] .= " ". $e->getMessage();
										$getAction[1] = "warning";
									}
								}
							}
						}
					} else {
						$getAction = array($this->langs->lang("YOUR_STORAGE_SPACE_IS_FULL", "system", true), "danger");
					}
				} else {
					$getAction = array($this->langs->lang("AN_ERROR_HAS_OCCURRED", "system", true), "danger");
				}
				
				if( $get['action'] == "uploadAjax" ) {
					echo json_encode($getAction);
					exit;
				}
			} 
			elseif( $get['action'] == "remove" ) {
				$getAction = FileSystems::remove($get['path'], $get['file'], $get['type'], $this->personnalRoot);
			} 
			elseif( $get['action'] == "download" ) {
				if( $get['type'] == "dir" ) {
					try {
						$archiver = new Archiver($this->personnalRoot . $get['path'] ."/". $get['file'], $this->tmpRoot, $get['file']);
						
						if( isset($this->requests->post->ajax) && $this->requests->post->ajax == true ) {
							$getAction = $archiver->downloadArchive(true);
						} else {
							$getAction = $archiver->downloadArchive(false);
						}
					} catch (Exception $e) {
						$getAction = array($e->getMessage(), "danger");
					}
				} elseif( $get['type'] == "file" ) {
					$pathToFile = $this->personnalRoot . $get['path'] ."/". $get['file'];
					
					try {
						$downloader = new Downloader($pathToFile, $this->tmpRoot, $get['file']);
						$getAction = $downloader->download();
					} catch (Exception $e) {
						$getAction = array($e->getMessage(), "danger");
					}
				} else {
					$getAction = array("ERREUR : BLAAAAHHHH", "danger");
				}
			} 
			elseif( $get['action'] == "archive" ) {
				if( $get['type'] == "dir" ) {
					try {
						$archiver = new Archiver($this->personnalRoot . $get['path'] ."/". $get['file'], $this->personnalRoot . $get['path'] ."/", $get['file']);
						
						if( isset($this->requests->post->ajax) && $this->requests->post->ajax == true ) {
							$getAction = $archiver->createArchive(true);
						} else {
							$getAction = $archiver->createArchive(false);
						}
					} catch (Exception $e) {
						$getAction = array($e->getMessage(), "danger");
					}
				} else {
					$getAction = array($this->langs->lang("A_FOLDER_MUST_BE_SELECTED", "system", true), "warning");
				}
			} else {
				$getAction = array($this->langs->lang("AN_ERROR_HAS_OCCURRED", "system", true), "danger");
			}
			
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
			
			if( !empty($post->add_folder) ) {
				if( !empty($post->folder_name) ) {
					$folderName = $post->folder_name;
					
					if( isset($path) ) {
						$folderPath = $pathImploded;
						$folderName = $folderPath ."/". $folderName;
					}
					
					$createDir = FileSystems::createDir($folderName, $this->personnalRoot);
					
					$message = $createDir[0];
					$type = $createDir[1];
				} else {
					$message = "Veuillez entré un nom de dossier";
					$type = "warning";
				}
				
			} 
			elseif( !empty($post->action_mass_download) ) {
				if( !empty($post->select_file) ) {
					$massDownload = $post->select_file;
					$massDownload['root'] = $this->personnalRoot;
					$massDownload['file_path'] = !empty($path) ? $pathImploded : "";
					
					try {
						$archiver = new Archiver($massDownload, $this->tmpRoot);
						
						if( isset($post->ajax) && $post->ajax == true ) {
							$getAction = $archiver->downloadArchive(true);
						} else {
							$getAction = $archiver->downloadArchive(false);
						}
					} catch (Exception $e) {
						$getAction = array($e->getMessage(), "danger");
					}
				} else {
					$message = $this->langs->lang("NO_FILE_SELECTED", "system", true);
					$type = "warning";
				}
			} 
			elseif( !empty($post->action_mass_move) ) {
				if( !empty($post->select_file) ) {
					$massMoved = FileSystems::move($post->mass_move['old_path'], $post->mass_move['new_path'], $this->personnalRoot, $post->select_file);
				} else {
					$massMoved = array($this->langs->lang("NO_FILE_SELECTED", "system", true), "warning");
				}
				
				$message = $massMoved[0];
				$type = $massMoved[1];
			} 
			elseif( !empty($post->action_mass_rename) ) {
				if( !empty($post->select_file) ) {
					$massRenamerSelectFile = $post->select_file;
					
					if( !empty($path) ) {
						$massRenamerSelectFile['file_path'] = $pathImploded;
					}
					
					$massRenamer = FileSystems::renamer($massRenamerSelectFile, $post->mass_renamer['name'], $personnalDriveTotal, $this->personnalRoot);
				} else {
					$massRenamer = array($this->langs->lang("NO_FILE_SELECTED", "system", true), "warning");
				}
				
				$message = $massRenamer[0];
				$type = $massRenamer[1];
			} 
			elseif( !empty($post->action_mass_remove) ) {
				if( !empty($post->select_file) ) {
					$massRemoveSelectFile = $post->select_file;
					$massRemoveFilePath = "";
					
					if( !empty($path) ) {
						$massRemoveFilePath = "/". $pathImploded;
					}
					
					$massRemoved = FileSystems::remove($massRemoveFilePath, $massRemoveSelectFile, "", $this->personnalRoot);
				} else {
					$massRemoved = array($this->langs->lang("NO_FILE_SELECTED", "system", true), "warning");
				}
				
				$message = $massRemoved[0];
				$type = $massRemoved[1];
			} 
			elseif(!empty($post->file_renamer) || !empty($post->dir_renamer) || !empty($post->file_move) || !empty($post->dir_move)) {
				$outputAction = array($this->langs->lang("PLEASE_FILL_IN_THE_FIELD", "system", true), "warning");
				
				if( !empty($post->file_renamer) ) {
					foreach( $post->file_renamer['file'] as $key => $value ) {
						if( !empty($value) ) {
							$fileRenamer['oldname'] = $this->personnalRoot . $post->file_renamer['path'][$key];
							$pdt = gettype($personnalDriveTotal) != "boolean" ? $personnalDriveTotal : array();
							$outputAction = FileSystems::renamer($fileRenamer['oldname'], $value, $pdt, $this->personnalRoot);
							
							break;
						}
					}
				}
				
				if( !empty($post->dir_renamer) ) {
					foreach( $post->dir_renamer['dir'] as $key => $value ) {
						if( !empty($value) ) {
							$dirRenamer['oldname'] = $this->personnalRoot . $post->dir_renamer['path'][$key];
							$pdt = gettype($personnalDriveTotal) != "boolean" ? $personnalDriveTotal : array();
							$outputAction = FileSystems::renamer($dirRenamer['oldname'], $value, $pdt, $this->personnalRoot);
							
							break;
						}
					}
				}
				
				if( !empty($post->file_move) ) {
					foreach( $post->file_move['new_path'] as $key => $value ) {
						if( !empty($value) ) {
							$fileMove['new_path'] = $this->personnalRoot . $value;
							$fileMove['old_path'] = $this->personnalRoot . $post->file_move['old_path'][$key];
							$outputAction = FileSystems::move($fileMove['old_path'], $fileMove['new_path'], $this->personnalFolder);
							
							break;
						}
					}
				}
				
				if( !empty($post->dir_move) ) {
					foreach( $post->dir_move['new_path'] as $key => $value ) {
						if( !empty($value) ) {
							$dirMove['new_path'] = $this->personnalRoot . $value;
							$dirMove['old_path'] = $this->personnalRoot . $post->dir_move['old_path'][$key];
							$outputAction = FileSystems::move($dirMove['old_path'], $dirMove['new_path'], $this->personnalFolder);
							
							break;
						}
					}
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
	
	/* public function massUploads(array $datas, array $getCustomer): array {
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
					
					// if( !empty($get_files) ) {
						// foreach($get_files as $get_file) {
							// if( basename($get_file) === basename($target_file[$i]) ) {
								// $slice_file = array_slice(explode("/", $get_file), 10);
								// $message = array("Un fichier du même nom existe déjà, '/". implode('/', $slice_file) ."'", "warning");
								
								// return $message;
							// }
						// }
					// }
					
					if( $getCustomer['access'] > 2 ) {
						if( $datas['size'][$i] > 10000000 ) {
							$message = array("Désolé, le fichier est trop volumineux, taille max. 10Mo", "warning");
							
							return $message;
						}
					}
					
					if( empty(in_array($imageFileType[$i], $this->fileFormat())) ) {
						$message = array("Désolé, les fichiers autorisé sont de type ". implode(", ", $this->fileFormat()) ."", "warning");
						
						return $message;
					}
					
					if( move_uploaded_file($datas['tmp_name'][$i], $target_file[$i]) ) {
						if( !empty(in_array(mime_content_type($target_file[$i]), $accept_file_format)) ) {
							if( $file_counter > 1 ) {
								$message = array("L'enregistrement des fichiers s'est déroulé avec succès", "success");
							} else {
								$message = array("L'enregistrement du fichier ". htmlspecialchars(basename($datas['name'][$i])) ." s'est déroulé avec succès", "success");
							}
						} else {
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
	} */
	
	function fileFormat(): ?array {
		if( !class_exists('Params') ) {
			$this->loadModels('Params');
		}
		$getParams = $this->Params->getParams();
		
		return $file_format = explode(",", $getParams['accept_ext_file']);
	}
	
}

?>
