<?php

defined('_EXEC') or die;

class Config {
	public string $theme = "js-info";
	// public $theme = "vivo";
	public int $debug = 0;
	public string $error_reporting = "devloppment";
	// public string $default_lang = "fr-FR";
	public string $default_lang = "en-EN";
	// public string $default_lang = "de-DE";
	public string $siteurl = "https://crm.js-info.fr";
	public string $contact_siteurl = "https://js-info.fr/nous-contacter";
	public string $root_path = $_SERVER['DOCUMENT_ROOT'];
	public string $sitename = "Js info";
	public string $MetaTitle = "Espace personnel";
	public string $MetaDesc = "Espace personnel Js info";
	public string $MetaAuthor = "Julien Senechal - Js info";
	public string $MetaVersion = "1.2.8";
	public string $robots = "index,follow";
}
