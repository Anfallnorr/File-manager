<?php

defined('_EXEC') or die;

class Config {
	public $theme = "vivo";
	public $debug = 0;
	public $error_reporting = "devloppment";
	public $default_lang = "fr-FR";
	public $siteurl = "https://crm.js-info.fr";
	public $contact_siteurl = "https://js-info.fr/nous-contacter";
	public $root_path = $_SERVER['DOCUMENT_ROOT'];
	public $sitename = "Js info";
	public $MetaTitle = "Espace personnel";
	public $MetaDesc = "Espace personnel Js info";
	public $MetaAuthor = "Julien Senechal - Js info";
	public $MetaVersion = "1.1.3";
	public $robots = "noindex,nofollow";
}
