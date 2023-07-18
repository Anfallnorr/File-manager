<?php

defined('_EXEC') or die;

class data extends Controllers {
	
    protected $personnalFolder;
    protected $personnalRoot;
    protected $personnalThumbRoot;
    protected $tmpRoot;
	
	public function __construct(object $requests, object $session, object $config) {
		if( $session->readSession('user') !== null ) {
			$this->personnalFolder = $session->readSession('user')['datas']['personnal_folder'];
			$this->personnalRoot = _ROOTURL_ ."/uploads/datas/". $this->personnalFolder;
			$this->personnalThumbRoot = $this->personnalRoot ."/thumbnails";
		} else {
			$this->personnalFolder = "";
			$this->personnalRoot = "";
			$this->personnalThumbRoot = "";
		}
		
		// debug($this->session->readSession('user'));
		// debug('toto', true);
		$this->tmpRoot = _ROOTURL_ ."/uploads/tmp/";
		
		// parent::__construct($requests, $session, $config);
	}
	
	public function data(): void {
		
	}
	
	// public function massUploads(array $datas, array $getCustomer): array {
		
	// }
	
	// public function massUploadsAjax(): array|string {
		
	// }
	
	/**
	 * Fonction qui permet de redimensionner une image en conservant les proportions
	 * @param  string  $image_path Chemin de l'image
	 * @param  string  $imageDest Chemin de destination de l'image redimentionnée (si vide remplace l'image envoyée)
	 * @param  integer $maxSize   Taille maximale en pixels
	 * @param  integer $qualite    Qualité de l'image entre 0 et 100
	 * @param  string  $type       'auto' => prend le coté le plus grand
	 *                             'width' => prend la largeur en référence
	 *                             'height' => prend la hauteur en référence
	 * @param  boleen  $upload 	   true si c'est une image uploadée, false si c'est le chemin d'une image déjà sur le serveur
	 * @return string              'success' => redimentionnement effectué avec succès
	 *                             'wrong_path' => le chemin du fichier est incorrect
	 *                             'no_img' => le fichier n'est pas une image
	 *                             'resize_error' => le redimensionnement a échoué
	 */
	// function resize_img($image_path, $imageDest, $maxSize = 500, $qualite = 100, $type = 'auto', $upload = false) {
	// function resizeImg(array $image, string $personnalFolder): string {
		
	// }
	
}

?>