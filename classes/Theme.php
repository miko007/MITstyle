<?php

namespace mitstyle;

class Theme {
	private $ADMIN;

	public function __construct() {
		$this->ADMIN = new Admin();
		add_action('after_setup_theme',	array($this, 'generalSetup'));
	}

	public function generalSetup() {
		add_theme_support('title-tag');
		add_theme_support('custom-background');
		add_theme_support('post-formats', array(
			'image',
			'quote',
			'status',
			'video',
			'aside'
		));
		register_nav_menu('top', 'Hauptmenü');
	}

	public static function getColorScheme() {
		//$schemeActive 	= get_option("MITcolorScheme");
		$schemes 		= json_decode(file_get_contents(MITSTYLE_PATH."/json/colorSchemes.json"));
		//return $schemes->$schemeActive;
		return $schemes->default;
	}

	public static function getSocial() {
		return json_decode(base64_decode(get_option("MITsocial")));
	}

	public static function getSocialArray() {
		$out = array();
		foreach (Theme::getSocial() as $social) {
			$out[$social->name] = $social->link;
		}
		return $out;
	}
}
