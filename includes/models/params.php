<?php

defined('_EXEC') or die;

class Params
{
	public function getParams(array $condition = [], bool $current = false): array
	{
		$getParams = array(
			'id' => 1,
			'logo_site' => "/templates/systems/img/logo-light-blue.png",
			'icon_site' => "/templates/systems/img/icon-dark-blue.png",
			'favicon_site' => "/templates/systems/img/favicon-dark-blue.ico",
			'menu' => "vertical",
			'email_admin' => "demo@demo.fr",
			'pre_loader' => 1,
			'menu_exclude' => "apps",
			'upload_select' => "dropzone",
			'accept_ext_file' => "bmp,csv,xml,htm,html,css,js,json,php,map,yml,gif,ico,jpg,jpeg,png,svg,ai,odg,odp,ods,odt,pst,rtf,doc,docx,pdf,mp3,m4a,aac,mid,midi,ogg,oga,mp4,3gp,avi,mpeg,ogv,otf,ppt,pptx,txt,xcf,xls,jar,zip,rar,bz,bz2,apk,exe,msi,ogx,tif,psd,ttf,dxf,eps,webp",
			'refresh_top' => 0,
			'home_top' => 1,
			'notif_top' => 1,
			'clock_top' => 0,
			'avatar_sidebar' => 0,
			'name_sidebar' => 0,
			'search_sidebar' => 1,
		);
		
		if ($current) {
			return current($getParams);
		} else {
			return $getParams;
		}
	}
}

?>