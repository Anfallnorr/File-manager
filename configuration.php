<?php

defined('_EXEC') or die;

class Config {
	public $theme = "js-info";
	// public $theme = "vivo";
	public $debug = 0;
	public $error_reporting = "devloppment";
	// public $default_lang = "fr-FR";
	public $default_lang = "en-EN";
	// public $default_lang = "de-DE";
	public $siteurl = "https://crm.js-info.fr";
	public $contact_siteurl = "https://js-info.fr/nous-contacter";
	public $root_path = $_SERVER['DOCUMENT_ROOT'];
	public $sitename = "Js info";
	public $MetaTitle = "Espace personnel";
	public $MetaDesc = "Espace personnel Js info";
	public $MetaAuthor = "Julien Senechal - Js info";
	public $MetaVersion = "1.2.8";
	public $robots = "index,follow";
}
