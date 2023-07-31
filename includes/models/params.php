<?php

class Params/*  extends Models */ {
	
	public $table = "params";
	public $primaryKey = "id";
	
	public function getParams(array $condition = [], bool $current = false) {
		$getParams = array(
			'id' => 1,
			'logo_site' => "/assets/img/logo-light-blue.png",
			'icon_site' => "/assets/img/icon-dark-blue.png",
			'favicon_site' => "/assets/img/favicon-dark-blue.ico",
			'menu' => "vertical",
			'email_admin' => "crm@js-info.fr",
			'pre_loader' => 1,
			'menu_exclude' => "authentications,apps",
			// 'google_map_key' => "AIzaSyD8BXgooP5jvtGkgSIs8DWVHMOGfw2oTkg",
			// 'captcha_site_key' => "6Lfm1OkbAAAAAMxDShfgjxCmefbWkmi11kMTsevH",
			// 'captcha_secret_key' => "6Lfm1OkbAAAAAJEOR-_9Uv_NzSI7kiEB9d2pv9tN",
			'upload_select' => "dropzone",
			'accept_ext_file' => "bmp,csv,xml,htm,html,css,js,json,php,map,yml,gif,ico,jpg,jpeg,png,svg,ai,odg,odp,ods,odt,pst,rtf,doc,docx,pdf,mp3,m4a,aac,mid,midi,ogg,oga,mp4,3gp,avi,mpeg,ogv,otf,ppt,pptx,txt,xcf,xls,jar,zip,rar,bz,bz2,apk,exe,msi,ogx,tif,psd,ttf,dxf,eps,webp",
			// 'img_avatar' => "500,500",
			// 'img_product' => "540,300",
			// 'img_categorie' => "200,200",
			'refresh_top' => 0,
			'home_top' => 1,
			'notif_top' => 1,
			'clock_top' => 0,
			'avatar_sidebar' => 0,
			'name_sidebar' => 0,
			'search_sidebar' => 1,
		);
		
		if( $current == true ) {
			return current($getParams);
		} else {
			return $getParams;
		}
	}
	
}

?>